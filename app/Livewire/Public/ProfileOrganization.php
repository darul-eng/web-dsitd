<?php

declare(strict_types=1);

namespace App\Livewire\Public;

use App\Models\Member;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ProfileOrganization extends Component
{
    public string $treeData = '{}';
    public $members;
    public $stats = [];

    public function mount(): void
    {
        $this->members = Member::query()
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        // Stats for the dashboard
        $this->stats = [
            'apps' => 150,
            'users' => '40k',
            'uptime' => '99.9%'
        ];

        if ($this->members->isEmpty()) {
            $this->treeData = json_encode([
                'id'       => 0,
                'name'     => 'Belum ada data',
                'position' => 'Silakan tambahkan data anggota',
                'image'    => '',
                'group'    => 'none',
                'children' => [],
            ], JSON_UNESCAPED_UNICODE);
            return;
        }

        // Keep hierarchy logic if needed for other parts, but we mainly use $members for the new UI
        $root = Member::query()
            ->where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('order')
            ->with('childrenRecursive')
            ->first();

        if ($root) {
            $this->treeData = json_encode($this->buildTree($root), JSON_UNESCAPED_UNICODE);
        }
    }

    private function buildTree(Member $member): array
    {
        $children = $member->childrenRecursive
            ->where('is_active', true)
            ->sortBy('order')
            ->values();

        return [
            'id'       => $member->id,
            'name'     => $member->fullname,
            'position' => $member->position,
            'group'    => $member->position_group,
            'image'    => $this->memberImage($member),
            'children' => $children->map(fn (Member $child) => $this->buildTree($child))->all(),
        ];
    }

    private function buildTreeFromPositionGroup(Collection $members): array
    {
        $groupLevel = [
            'direktur'  => 0, 'pimpinan' => 0,
            'kasubdit'  => 1, 'pengelola' => 1,
            'kepala-seksi' => 2,
            'tim-jaringan' => 3, 'tim-helpdesk' => 3, 'tim-programmer' => 3,
            'staff' => 3, 'teknisi' => 3,
        ];

        $buckets = [];
        foreach ($members as $member) {
            $level = $groupLevel[$member->position_group] ?? 99;
            $buckets[$level][] = $this->mapMemberNode($member);
        }
        ksort($buckets);

        $levels = array_values($buckets);

        if (empty($levels)) {
            return $this->mapMemberNode($members->first());
        }

        $topNodes = $levels[0];
        $root = array_shift($topNodes);

        if (!empty($topNodes)) {
            $root['children'] = $topNodes;
        }

        $parentNodes = [&$root];
        if (!empty($root['children'])) {
            $parentNodes = [];
            foreach ($root['children'] as &$child) {
                $parentNodes[] = &$child;
            }
            unset($child);
        }

        for ($i = 1; $i < count($levels); $i++) {
            $currentLevel = $levels[$i];

            if (empty($parentNodes)) {
                $root['children'] = array_merge($root['children'] ?? [], $currentLevel);
                continue;
            }

            $parentCount = count($parentNodes);
            $chunkSize = max(1, (int) ceil(count($currentLevel) / $parentCount));
            $chunks = array_chunk($currentLevel, $chunkSize);

            $nextParents = [];
            foreach ($parentNodes as $idx => &$parent) {
                if (isset($chunks[$idx])) {
                    $parent['children'] = array_merge($parent['children'] ?? [], $chunks[$idx]);
                    foreach ($parent['children'] as &$newChild) {
                        $nextParents[] = &$newChild;
                    }
                    unset($newChild);
                }
            }
            unset($parent);

            $parentNodes = $nextParents;
        }

        return $root;
    }

    private function mapMemberNode(Member $member): array
    {
        return [
            'id'       => $member->id,
            'name'     => $member->fullname,
            'position' => $member->position,
            'group'    => $member->position_group,
            'image'    => $this->memberImage($member),
            'children' => [],
        ];
    }

    public function memberImage(Member $member): string
    {
        $rawImage = $member->getRawOriginal('image');
        
        if (!$rawImage) {
            return 'https://i.pravatar.cc/150?u=' . $member->uuid;
        }

        if (str_starts_with($rawImage, 'http')) {
            return $rawImage;
        }

        return asset('storage/' . $rawImage);
    }

    public function render(): View
    {
        return view('livewire.public.profile-organization');
    }
}
