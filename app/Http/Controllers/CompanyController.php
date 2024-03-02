<?php

namespace App\Http\Controllers;

use App\Models\CompanyDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller {
    public function index( Request $request ) {
        $user  = auth()->user();
        $query = CompanyDetail::query();

        if ( $request->has( 'search' ) ) {
            $query->where( 'name', 'like', '%'.$request->search.'%' );
        }

        if ( $request->has( 'sort' ) ) {
            $sortValue = $request->sort;
            if ( $sortValue === 'active' ) {
                $query->where( 'status', 'active' )->orderBy( 'status', 'asc' );
            } elseif ( $sortValue === 'inactive' ) {
                $query->where( 'status', 'inactive' )->orderBy( 'status', 'desc' );
            }
        }

        $companies = $query->paginate( 5 );

        return view( 'company.companies', compact( 'companies', 'user' ) );
    }

    public function show( $id ) {
        $user    = auth()->user();
        $company = CompanyDetail::findOrFail( $id );
        return view( 'company.companyDetails', compact( 'company', 'user' ) );
    }

    public function update( Request $request, $id ) {

        $request->validate( [
            'status' => 'required',
        ] );

        $company = CompanyDetail::findOrFail( $id );

        $company->update( [
            'status' => $request->status,
        ] );

        return redirect()->route( 'company.show', $company->id )->with( 'success', 'Company status updated successfully.' );
    }

    public function destroy( $id ) {
        DB::beginTransaction();

        try {
            $company = CompanyDetail::findOrFail( $id );

            $user = $company->user;
            if ( $user ) {
                $user->delete();
            }

            $company->delete();

            DB::commit();

            return redirect()->back()->with( 'success', 'Company and associated user deleted successfully' );
        } catch ( Exception $e ) {
            DB::rollBack();
            return redirect()->back()->with( 'error', 'Failed to delete company and associated user' );
        }
    }

}