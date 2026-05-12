<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Members;

use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $group = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'group' => ['except' => ''],
    ];

    public function mount(): void
    {
        $this->group = $this->normalizeGroupFilter($this->group);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingGroup(string $value): void
    {
        $this->group = $this->normalizeGroupFilter($value);
        $this->resetPage();
    }

    public function delete(string $uuid)
    {
        $member = Member::where('uuid', $uuid)->firstOrFail();
        $member->delete();

        session()->flash('message', 'Personnel berhasil dihapus.');
    }

    public function toggleStatus(string $uuid)
    {
        $member = Member::where('uuid', $uuid)->firstOrFail();
        $member->is_active = !$member->is_active;
        $member->save();
    }

    public function render()
    {
        $groupFilterValues = $this->groupFilterValues($this->group);

        $members = Member::query()
            ->when($this->search, function ($query) {
                $query->where(function($q) {
                    $q->where('fullname', 'like', '%' . $this->search . '%')
                      ->orWhere('nip', 'like', '%' . $this->search . '%');
                });
            })
            ->when(!empty($groupFilterValues), function ($query) use ($groupFilterValues) {
                $query->whereIn('position_group', $groupFilterValues);
            })
            ->orderBy('order')
            ->orderBy('fullname')
            ->paginate(12);

        $groups = Member::select('position_group')->distinct()->pluck('position_group');

        return view('livewire.admin.members.index', [
            'members' => $members,
            'groups' => $groups,
        ]);
    }

    private function normalizeGroupFilter(string $group): string
    {
        return match ($group) {
            'pimpinan' => 'direktur',
            'pengelola' => 'kasubdit',
            'staff' => 'tim-helpdesk',
            'teknisi' => 'tim-programmer',
            default => $group,
        };
    }

    private function groupFilterValues(string $group): array
    {
        return match ($group) {
            'direktur' => ['direktur', 'pimpinan'],
            'kasubdit' => ['kasubdit', 'pengelola'],
            'kepala-seksi' => ['kepala-seksi'],
            'tim-jaringan' => ['tim-jaringan'],
            'tim-helpdesk' => ['tim-helpdesk', 'staff'],
            'tim-programmer' => ['tim-programmer', 'teknisi'],
            default => [],
        };
    }
}
