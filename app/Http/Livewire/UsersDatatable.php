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
    public $role = '';
    public $iId = '';
    public $region = '';

    public $rules = [
        'name'   => 'required | min:6',
        'email'  => 'required | email',
        'role'   => 'required | in:admin,user,top',
        'region' => 'required_if:role,user'
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
                return (\strtolower($sRole) === 'admin') ? 'Admin' : (((\strtolower($sRole) === 'user')) ? 'CHED Regional Officer' : 'Top Management');
            })->label('Role'),
            Column::callback('region', function($sRegion) {
                return (strlen($sRegion) <= 0) ? 'None' : $sRegion;
            })->label('Region'),
            DateColumn::name('updated_at')->label('Updated at'),
            Column::callback(['id', 'is_active'], function ($iId, $sIsActive) {
                return view('livewire.users-datatable', [
                    'id'   => $iId,
                    'isActive' => intval($sIsActive) === 1,
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
        $this->region = $oUser->region;
    }

    public function toggleVisibility(int $iId) {
        $oUser = UserModel::find($iId);
        $oUser->is_active = !$oUser->is_active;
        $oUser->save();
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
        $oUser->region = $this->region;
        $oUser->password = \bcrypt((\env('APP_ENV', 'local') === 'local') ? 'password' : 'password' . rand(20, 100));
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
        $oUser->region = $this->region;
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
        $this->region = '';
        $this->clearValidation();
    }
}
