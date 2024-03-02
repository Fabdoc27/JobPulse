<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $user = User::create( [
            'email'    => 'owner@admin.com',
            'password' => Hash::make( '123' ),
            'role'     => 'owner',
        ] );

        // for receiving email from visitors
        $email = $user->email;

        $envFilePath = base_path( '.env' );

        $envContents = File::get( $envFilePath );

        if ( !Str::contains( $envContents, 'OWNER_EMAIL=' ) ) {
            File::append( $envFilePath, 'OWNER_EMAIL='.$email );
        } else {
            $envContents = preg_replace(
                '/^OWNER_EMAIL=(.*)/m',
                'OWNER_EMAIL='.$email,
                $envContents
            );
            File::put( $envFilePath, $envContents );
        }
    }
}