@extends('layouts.app')

@section('content')

    <navbar-admin firstname="{{ auth()->user()->fname }}"></navbar-admin>
    <dashboard-page></dashboard-page>

@endsection

        <script>
            import NavbarAdmin from "../../js/components/Administrator/NavbarAdmin";
            export default {
                components: {NavbarAdmin}
            }
        </script>
