<?php

namespace App\Http\Controllers;

use App\Helper\PluginHelper;
use App\Models\CompanyDetail;
use App\Models\Plugin;
use App\Models\User;
use Illuminate\Http\Request;

class PluginsController extends Controller {
    public function index( Request $request ) {
        $userId      = $request->user()->id;
        $user        = User::findOrFail( $userId );
        $plugins     = Plugin::all();
        $companyData = PluginHelper::getCompanyPlugins( $user );
        return view( 'plugins.index', compact( 'plugins', 'user', 'companyData' ) );
    }

    public function create( Request $request ) {
        $userId = $request->user()->id;
        $user   = User::findOrFail( $userId );
        return view( 'plugins.create', compact( 'user' ) );
    }

    public function store( Request $request ) {
        $request->validate( [
            'name'     => 'required',
            'features' => 'nullable',
        ] );

        Plugin::create( [
            'name'     => $request->name,
            'features' => $request->features,
        ] );

        return redirect()->route( 'plugin.index' )->with( 'success', 'Plugin created successfully.' );
    }

    public function edit( Request $request, Plugin $plugin ) {
        $userId = $request->user()->id;
        $user   = User::findOrFail( $userId );
        return view( 'plugins.edit', compact( 'plugin', 'user' ) );
    }

    public function update( Request $request, Plugin $plugin ) {
        $request->validate( [
            'name'     => 'nullable',
            'features' => 'nullable',
        ] );

        $plugin->update( [
            'name'     => $request->name,
            'features' => $request->features,
        ] );

        return redirect()->route( 'plugin.index' )->with( 'success', 'Plugin updated successfully.' );
    }

    public function destroy( Plugin $plugin ) {
        $plugin->delete();
        return redirect()->route( 'plugin.index' )->with( 'success', 'Plugin deleted successfully.' );
    }

    public function pluginStatus( Request $request, Plugin $plugin ) {
        $userId   = auth()->user()->id;
        $pluginId = $request->input( 'plugin_id' );

        $companyDetails = CompanyDetail::where( 'user_id', $userId )->first();

        if ( $companyDetails ) {
            $existingRecord = $companyDetails->plugins()->where( 'plugin_id', $pluginId )->first();

            if ( $existingRecord ) {
                $existingRecord->pivot->update( [
                    'status' => $existingRecord->pivot->status === 'active' ? 'inactive' : 'active',
                ] );

                $message = $existingRecord->pivot->status === 'inactive' ? 'deactivated' : 'activated';
                return redirect()->back()->with( 'success', "Plugin successfully $message." );
            } else {
                $companyDetails->plugins()->attach( $pluginId, ['status' => 'active'] );
                return redirect()->back()->with( 'success', 'Plugin successfully activated.' );
            }
        } else {
            return redirect()->back()->with( 'error', 'Something went wrong' );
        }
    }
}