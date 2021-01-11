<?php

namespace App\Http\Livewire;

use App\Models\UserModel;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;
use TheSeer\Tokenizer\Exception;

class UsersDatatable extends LivewireDatatable
{
    public $model = UserModel::class;
    public $beforeTableSlot = 'livewire.users-datatable';
    public $confirmEdit = false;
    public $confirmAdd = false;
    public $name = '';
    public $email = '';
    public $role = 'user';
    public $iId = '';

    public $rules = [
        'name'  => 'required | min:10',
        'email' => 'required | email',
        'role'  => 'required | in:admin,user'
    ];

    public function columns()
    {
        return [
            NumberColumn::name('id')->hide(),
            Column::callback(['profile_photo_path', 'name'], function ($sProfile, $sName) {
                return view('livewire.users-datatable', [
                    'profile' => $sProfile,
                    'name'    => $sName,
                    'type'    => 'profile'
                ]);
            }),
            Column::name('name')->label('Name'),
            Column::name('email')->label('Email'),
            Column::callback(['role'], function ($sRole) {
                return (\strtolower($sRole) === 'admin') ? 'Admin' : 'Top Management';
            })->label('Role'),
            DateColumn::name('updated_at')->label('Updated at'),
            Column::callback(['id'], function ($iId) {
                return view('livewire.users-datatable', [
                    'id'   => $iId,
                    'type' => 'action'
                ]);
            })->label('Action')
        ];
    }

    public function getUserInfo(int $iId)
    {
        $oUser = UserModel::find($iId);
        $this->name = $oUser->name;
        $this->email = $oUser->email;
        $this->role = $oUser->role;
        $this->iId = $oUser->id;
    }

    public function showConfirmEdit(int $iId)
    {
        $this->clear();
        $this->confirmEdit = true;
        $this->getUserInfo($iId);
    }

    public function showConfirmAdd()
    {
        $this->clear();
        $this->confirmAdd = true;
    }

    public function saveNewUser()
    {
        $this->validate();
        $oUser = new UserModel();
        $oUser->name = $this->name;
        $oUser->email = $this->email;
        $oUser->role = $this->role;
        $oUser->password = \bcrypt((\env('APP_ENV', 'local') === 'local') ? 'password' : 'password' . rand(20));
        if ($oUser->save()) {
            $this->confirmAdd = false;
            $this->clear();
        }

    }

    public function saveExistingUser()
    {
        $this->validate();
        $oUser = UserModel::find($this->iId);
        $oUser->name = $this->name;
        $oUser->email = $this->email;
        $oUser->role = $this->role;
        if ($oUser->save()) {
            $this->confirmEdit = false;
            $this->clear();
        }
    }

    public function clear()
    {
        $this->name = '';
        $this->email = '';
        $this->role = '';
        $this->iId = 0;
        $this->clearValidation();
    }
}
