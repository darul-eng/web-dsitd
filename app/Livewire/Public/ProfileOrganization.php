<?php

declare(strict_types=1);

namespace App\Livewire\Public;

use App\Models\Member;
use Illuminate\Contracts\View\View;
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
