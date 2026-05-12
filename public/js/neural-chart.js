/**
 * Structured Neural Network Organization Chart — D3.js v7
 * =====================================================
 * Uses a Tree layout for neat organization, but retains 
 * the Neural Network visual style (glowing nodes, synapses, pulses).
 */
(function () {
    'use strict';

    window.initNeuralChart = function (data) {
        if (!data || !d3) return;
        render(data);
    };

    function render(data) {
        const container = document.getElementById('neural-org-chart');
        if (!container) return;
        
        container.innerHTML = '';

        const width = container.clientWidth || window.innerWidth;
        const height = container.clientHeight || window.innerHeight - 64;

        // Configuration
        const RADIUS_ROOT = 45;
        const RADIUS_PLANET = 35;
        const RADIUS_MOON = 25;
        const RADIUS_STAFF = 16;

        // SVG Canvas setup
        const svg = d3.select(container)
            .append('svg')
            .attr('width', width)
            .attr('height', height)
            .style('font-family', "'Inter', sans-serif");

        // Sun Glow filter
        const defs = svg.append('defs');
        const filter = defs.append('filter').attr('id', 'sun-glow').attr('x', '-50%').attr('y', '-50%').attr('width', '200%').attr('height', '200%');
        filter.append('feGaussianBlur').attr('stdDeviation', '10').attr('result', 'blur');
        filter.append('feComposite').attr('in', 'SourceGraphic').attr('in2', 'blur').attr('operator', 'over');

        const g = svg.append('g');

        // Hierarchy and Tree Layout
        const root = d3.hierarchy(data);
        
        // Use nodeSize instead of size() to prevent squishing when there are many children
        const treeLayout = d3.tree()
            .nodeSize([110, 180]) 
            .separation((a, b) => a.parent == b.parent ? 1.2 : 1.5);

        treeLayout(root);

        // Center the tree horizontally and push it down vertically
        const initialX = width / 2;
        const initialY = 120;
        
        // Zoom Behavior
        const zoomBehavior = d3.zoom()
            .scaleExtent([0.1, 4])
            .on('zoom', (event) => g.attr('transform', event.transform));
        
        svg.call(zoomBehavior);
        
        // Apply initial transform to center the root node
        svg.call(zoomBehavior.transform, d3.zoomIdentity.translate(initialX, initialY));

        window.__neuralChart = {
            zoomIn: () => svg.transition().duration(400).call(zoomBehavior.scaleBy, 1.3),
            zoomOut: () => svg.transition().duration(400).call(zoomBehavior.scaleBy, 0.7),
            resetZoom: () => svg.transition().duration(600).call(zoomBehavior.transform, d3.zoomIdentity.translate(initialX, initialY))
        };

        // Custom Link generator for smooth vertical bezier curves
        const linkGenerator = d3.linkVertical()
            .x(d => d.x)
            .y(d => d.y);

        // Draw Links (Synapses)
        const linkElements = g.append('g')
            .attr('class', 'links')
            .selectAll('path')
            .data(root.links())
            .enter().append('path')
            .attr('class', 'neural-link')
            .attr('d', linkGenerator)
            .attr('fill', 'none')
            .attr('stroke-width', d => Math.max(1, 4 - d.target.depth))
            // We give an ID to each path so we can select it for pulse animation
            .attr('id', (d, i) => 'link-' + i);

        // Pulse Containers
        const pulseGroup = g.append('g').attr('class', 'pulses');

        // Map hierarchy nodes to custom attributes
        root.descendants().forEach(d => {
            d.r = d.depth === 0 ? RADIUS_ROOT : 
                  d.depth === 1 ? RADIUS_PLANET : 
                  d.depth === 2 ? RADIUS_MOON : RADIUS_STAFF;
            d.strokeVar = d.depth === 0 ? 'var(--node-root)' : 
                          d.depth === 1 ? 'var(--node-planet)' : 
                          d.depth === 2 ? 'var(--node-moon)' : 'var(--node-staff)';
        });

        // Draw Nodes
        const nodeElements = g.append('g')
            .attr('class', 'nodes')
            .selectAll('g')
            .data(root.descendants())
            .enter().append('g')
            .attr('class', 'neural-node')
            .attr('transform', d => `translate(${d.x},${d.y})`);

        // Node Background Circles
        nodeElements.append('circle')
            .attr('class', 'neural-node-bg')
            .attr('r', d => d.r)
            .style('stroke', d => d.strokeVar)
            .style('filter', d => d.depth === 0 ? 'url(#sun-glow)' : null);

        // Node Avatars
        nodeElements.append('image')
            .attr('href', d => d.data.image || 'https://i.pravatar.cc/150')
            .attr('x', d => -(d.r - 2.5))
            .attr('y', d => -(d.r - 2.5))
            .attr('width', d => (d.r - 2.5) * 2)
            .attr('height', d => (d.r - 2.5) * 2)
            .style('clip-path', 'circle(50% at 50% 50%)')
            .style('-webkit-clip-path', 'circle(50% at 50% 50%)')
            .attr('preserveAspectRatio', 'xMidYMid slice')
            .style('pointer-events', 'none');

        // Text Labels (Hide for deep levels unless hovered to avoid clutter)
        nodeElements.filter(d => d.depth < 3).append('text')
            .attr('class', 'neural-text-primary text-glow')
            .attr('y', d => d.r + (d.depth === 0 ? 20 : 16))
            .attr('text-anchor', 'middle')
            .text(d => d.data.name)
            .style('font-size', d => d.depth === 0 ? '14px' : '11px');

        nodeElements.filter(d => d.depth < 3).append('text')
            .attr('class', 'neural-text-secondary text-glow')
            .attr('y', d => d.r + (d.depth === 0 ? 34 : 28))
            .attr('text-anchor', 'middle')
            .text(d => d.data.position)
            .style('font-size', d => d.depth === 0 ? '10px' : '8px');

        // Interactivity
        const pageEl = document.getElementById('org-chart-page');

        nodeElements.on('mouseenter', function (event, d) {
            // Dim other nodes & links slightly
            nodeElements.style('opacity', n => {
                // Keep path from root to current node, and children
                const isAncestor = n.ancestors().includes(d) || d.ancestors().includes(n);
                return isAncestor ? 1 : 0.2;
            });
            
            linkElements.style('opacity', l => {
                const sourceInPath = d.ancestors().includes(l.source) || l.source.ancestors().includes(d);
                const targetInPath = d.ancestors().includes(l.target) || l.target.ancestors().includes(d);
                return (sourceInPath && targetInPath) ? 1 : 0.1;
            });

            d3.select(this).select('.neural-node-bg')
                .style('stroke', 'var(--pulse-color)')
                .style('filter', 'drop-shadow(0 0 10px var(--pulse-color))');
            
            const detail = { id: d.data.id, name: d.data.name, position: d.data.position, image: d.data.image, group: d.data.group || 'organisasi' };
            try { Alpine.evaluate(pageEl, 'hoverMember = ' + JSON.stringify(detail)); } catch(e) {}
        });

        nodeElements.on('mouseleave', function (event, d) {
            nodeElements.style('opacity', 1);
            linkElements.style('opacity', 1);
            
            d3.select(this).select('.neural-node-bg')
                .style('stroke', d.strokeVar)
                .style('filter', d.depth === 0 ? 'url(#sun-glow)' : null);
                
            try { Alpine.evaluate(pageEl, 'hoverMember = null'); } catch(e) {}
        });

        nodeElements.on('click', function (event, d) {
            const detail = { id: d.data.id, name: d.data.name, position: d.data.position, image: d.data.image, group: d.data.group || 'organisasi' };
            try { Alpine.evaluate(pageEl, 'selectedMember = ' + JSON.stringify(detail)); } catch(e) {}
        });

        // ==========================================
        // SYNAPTIC PULSE ANIMATION ALONG PATHS
        // ==========================================
        
        function spawnPulse() {
            const linksArray = root.links();
            if (linksArray.length === 0) return;
            
            // Pick a random link index
            const index = Math.floor(Math.random() * linksArray.length);
            const pathNode = document.getElementById('link-' + index);
            
            if (!pathNode) return;
            
            const pathLength = pathNode.getTotalLength();

            const pulse = pulseGroup.append('circle')
                .attr('class', 'neural-pulse')
                .attr('r', 2.5);

            // Animate along the path
            const duration = 1500 + Math.random() * 2000; // 1.5 to 3.5 seconds
            
            pulse.transition()
                .duration(duration)
                .ease(d3.easeQuadInOut)
                .attrTween('transform', function() {
                    return function(t) {
                        // Get point at current percentage of the path
                        const p = pathNode.getPointAtLength(t * pathLength);
                        return `translate(${p.x},${p.y})`;
                    };
                })
                .on('end', function() {
                    d3.select(this).remove(); // Cleanup
                });
        }

        // Continually spawn pulses
        setInterval(spawnPulse, 80); // Spawn rapidly for neural effect
    }
})();
