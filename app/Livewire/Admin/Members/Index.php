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

    public function updatingSearch()
    {
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
        $members = Member::query()
            ->when($this->search, function ($query) {
                $query->where(function($q) {
                    $q->where('fullname', 'like', '%' . $this->search . '%')
                      ->orWhere('nip', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->group, function ($query) {
                $query->where('position_group', $this->group);
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
}
