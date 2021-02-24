<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'mail_management_access',
            ],
            [
                'id'    => '18',
                'title' => 'contact_create',
            ],
            [
                'id'    => '19',
                'title' => 'contact_edit',
            ],
            [
                'id'    => '20',
                'title' => 'contact_show',
            ],
            [
                'id'    => '21',
                'title' => 'contact_delete',
            ],
            [
                'id'    => '22',
                'title' => 'contact_access',
            ],
            [
                'id'    => '23',
                'title' => 'priority_create',
            ],
            [
                'id'    => '24',
                'title' => 'priority_edit',
            ],
            [
                'id'    => '25',
                'title' => 'priority_show',
            ],
            [
                'id'    => '26',
                'title' => 'priority_delete',
            ],
            [
                'id'    => '27',
                'title' => 'priority_access',
            ],
            [
                'id'    => '28',
                'title' => 'doc_type_create',
            ],
            [
                'id'    => '29',
                'title' => 'doc_type_edit',
            ],
            [
                'id'    => '30',
                'title' => 'doc_type_show',
            ],
            [
                'id'    => '31',
                'title' => 'doc_type_delete',
            ],
            [
                'id'    => '32',
                'title' => 'doc_type_access',
            ],
            [
                'id'    => '33',
                'title' => 'setting_access',
            ],
            [
                'id'    => '34',
                'title' => 'message_create',
            ],
            [
                'id'    => '35',
                'title' => 'message_edit',
            ],
            [
                'id'    => '36',
                'title' => 'message_show',
            ],
            [
                'id'    => '37',
                'title' => 'message_delete',
            ],
            [
                'id'    => '38',
                'title' => 'message_access',
            ],
            [
                'id'    => '39',
                'title' => 'msg_type_create',
            ],
            [
                'id'    => '40',
                'title' => 'msg_type_edit',
            ],
            [
                'id'    => '41',
                'title' => 'msg_type_show',
            ],
            [
                'id'    => '42',
                'title' => 'msg_type_delete',
            ],
            [
                'id'    => '43',
                'title' => 'msg_type_access',
            ],
            [
                'id'    => '44',
                'title' => 'msg_status_create',
            ],
            [
                'id'    => '45',
                'title' => 'msg_status_edit',
            ],
            [
                'id'    => '46',
                'title' => 'msg_status_show',
            ],
            [
                'id'    => '47',
                'title' => 'msg_status_delete',
            ],
            [
                'id'    => '48',
                'title' => 'msg_status_access',
            ],
            [
                'id'    => '49',
                'title' => 'archive_management_access',
            ],
            [
                'id'    => '50',
                'title' => 'archive_create',
            ],
            [
                'id'    => '51',
                'title' => 'archive_edit',
            ],
            [
                'id'    => '52',
                'title' => 'archive_show',
            ],
            [
                'id'    => '53',
                'title' => 'archive_delete',
            ],
            [
                'id'    => '54',
                'title' => 'archive_access',
            ],
            [
                'id'    => '55',
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);

    }
}