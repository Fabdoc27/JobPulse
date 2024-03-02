<?php

namespace App\Helper;

use App\Models\User;

class PluginHelper {
    public static function getCompanyPlugins( User $user ) {
        if ( $user->role === 'company' ) {
            $plugins       = $user->companyDetails->plugins()->get();
            $activePlugins = $plugins->where( 'pivot.status', 'active' );
            return ['plugins' => $plugins, 'activePlugins' => $activePlugins];
        }

        return [];
    }
}