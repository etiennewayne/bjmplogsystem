@extends('layouts.app')

@section('content')

    <navbar-admin  }}"></navbar-admin>
    <dashboard-page></dashboard-page>

@endsection

        <script>
            import NavbarAdmin from "../../js/components/Administrator/NavbarAdmin";
            export default {
                components: {NavbarAdmin}
            }
        </script>
