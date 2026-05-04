<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Members;

use App\Models\Member;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('layouts.admin')]
class Editor extends Component
{
    use WithFileUploads;

    public ?Member $memberModel = null;

    #[Validate('required|string|max:255')]
    public $fullname = '';

    #[Validate('nullable|string|max:50')]
    public $nip = '';

    #[Validate('required|string|max:255')]
    public $position = '';

    #[Validate('required|in:direktur,kasubdit,kepala-seksi,tim-jaringan,tim-helpdesk,tim-programmer')]
    public $position_group = 'tim-helpdesk';

    #[Validate('nullable|email|max:255')]
    public $email = '';

    #[Validate('nullable|string|max:20')]
    public $phone = '';

    #[Validate('nullable|string')]
    public $address = '';

    #[Validate('nullable|string')]
    public $gender = '';

    #[Validate('nullable|string')]
    public $place_of_birth = '';

    #[Validate('nullable|date')]
    public $date_of_birth = '';

    #[Validate('nullable|string')]
    public $religion = '';

    #[Validate('nullable|image|max:1024')]
    public $image = null;

    #[Validate('required|integer')]
    public $order = 0;

    #[Validate('required|boolean')]
    public $is_active = true;

    public function mount(string $uuid = null)
    {
        if ($uuid) {
            $this->memberModel = Member::where('uuid', $uuid)->firstOrFail();
            $this->fullname = $this->memberModel->fullname;
            $this->nip = $this->memberModel->nip;
            $this->position = $this->memberModel->position;
            $this->position_group = $this->mapLegacyPositionGroup($this->memberModel->position_group);
            $this->email = $this->memberModel->email;
            $this->phone = $this->memberModel->phone;
            $this->address = $this->memberModel->address;
            $this->gender = $this->memberModel->gender;
            $this->place_of_birth = $this->memberModel->place_of_birth;
            $this->date_of_birth = $this->memberModel->date_of_birth?->format('Y-m-d');
            $this->religion = $this->memberModel->religion;
            $this->order = $this->memberModel->order;
            $this->is_active = $this->memberModel->is_active;
        }
    }

    private function mapLegacyPositionGroup(string $positionGroup): string
    {
        return match ($positionGroup) {
            'pimpinan' => 'direktur',
            'pengelola' => 'kasubdit',
            'staff' => 'tim-helpdesk',
            'teknisi' => 'tim-programmer',
            default => in_array($positionGroup, [
                'direktur',
                'kasubdit',
                'kepala-seksi',
                'tim-jaringan',
                'tim-helpdesk',
                'tim-programmer',
            ], true) ? $positionGroup : 'tim-jaringan',
        };
    }

    public function save()
    {
        $this->validate();

        $data = [
            'fullname' => $this->fullname,
            'nip' => $this->nip,
            'position' => $this->position,
            'position_group' => $this->position_group,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'gender' => $this->gender,
            'place_of_birth' => $this->place_of_birth,
            'date_of_birth' => $this->date_of_birth ?: null,
            'religion' => $this->religion,
            'order' => $this->order,
            'is_active' => $this->is_active,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('members', 'public');
        }

        if ($this->memberModel) {
            $this->memberModel->update($data);
            session()->flash('message', 'Data personnel berhasil diperbarui.');
        } else {
            Member::create($data);
            session()->flash('message', 'Data personnel berhasil ditambahkan.');
        }

        return redirect()->route('admin.members.index');
    }

    public function render()
    {
        return view('livewire.admin.members.editor');
    }
}
