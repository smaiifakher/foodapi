@extends('layouts.admin.app')

@section('title',translate('Delivery Man TimeLog'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{translate('messages.dashboard')}}</a></li>
                <li class="breadcrumb-item" aria-current="page">{{translate('messages.deliveryman')}} {{translate('messages.view')}}</li>
            </ol>
        </nav>
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h1 class="page-header-title">{{$dm['f_name'].' '.$dm['l_name']}}</h1>
                </div>
                <div class="col-6">
                    <a href="{{url()->previous()}}" class="btn btn-primary float-right">
                        <i class="tio-back-ui"></i> {{translate('messages.back')}}
                    </a>
                </div>
                <div class="js-nav-scroller hs-nav-scroller-horizontal">
                    <!-- Nav -->
                    <ul class="nav nav-tabs page-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.delivery-man.preview', ['id'=>$dm->id, 'tab'=> 'info'])}}"  aria-disabled="true">{{translate('messages.info')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.delivery-man.preview', ['id'=>$dm->id, 'tab'=> 'transaction'])}}"  aria-disabled="true">{{translate('messages.transaction')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('admin.delivery-man.preview', ['id'=>$dm->id, 'tab'=> 'timelog'])}}"  aria-disabled="true">{{translate('messages.timelog')}}</a>
                        </li>
                    </ul>
                    <!-- End Nav -->
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Card -->
        <div class="card mb-3 mb-lg-5 mt-2">
            <div class="card-header">
                <h3 class="qcont px-3 pt-4">{{ translate('messages.order')}} {{ translate('messages.transactions')}}</h3>
{{--                 <div class="col-sm-auto" style="width: 306px;" >
                    <input type="date" class="form-control" onchange="set_filter('{{route('admin.delivery-man.preview',['id'=>$dm->id, 'tab'=> 'transaction'])}}',this.value, 'date')" value="{{request('date')}}">
                </div>
                <div class="col-sm-auto" style="width: 306px;" >
                    <input type="date" class="form-control" onchange="set_filter('{{route('admin.delivery-man.preview',['id'=>$dm->id, 'tab'=> 'transaction'])}}',this.value, 'date')" value="{{request('date')}}">
                </div> --}}




            </div>
            <!-- Body -->
            <div class="card-body">
                <form class="row" action="{{url()->current()}}">
                    <div class="col-4">
                        <div class="mb-3">
                            <input type="date" name="from" id="from" {{request('from')?'value='.request('from'):''}}
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <input type="date" name="to" id="to" {{request('to')?'value='.request('to'):''}}
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary btn-block">{{__('messages.show')}}</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table id="datatable"
                        class="table table-borderless table-thead-bordered table-nowrap justify-content-between table-align-middle card-table"
                        style="width: 100%">
                        <thead class="thead-light">
                            <tr>
                                <th>{{translate('messages.sl#')}}</th>
                                <th>{{translate('messages.date')}}</th>
                                <th>{{translate('messages.active_time')}} ({{translate('H:M')}})</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($timelogs as $key=>$timelog)
                            <tr>
                                <td scope="row">{{$key+$timelogs->firstItem()}}</td>
                                <td>{{$timelog->date}}</td>
                                <td>{{str_pad((int)($timelog->working_hour/60), 2, '0', STR_PAD_LEFT)}}:{{str_pad((int)($timelog->working_hour % 60), 2, '0', STR_PAD_LEFT)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End Body -->
            <div class="card-footer">
                {!!$timelogs->links()!!}
            </div>
        </div>
        <!-- End Card -->
    </div>
@endsection

@push('script_2')
<script>
    function request_alert(url, message) {
        Swal.fire({
            title: 'Are you sure?',
            text: message,
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#FC6A57',
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                location.href = url;
            }
        })
    }
</script>
@endpush
