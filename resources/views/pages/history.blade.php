@extends('layouts.app')
@section('content')
<div class="container-fluid app-body settings-page">
	<div class="panel panel-default">
        <div class="panel-heading">
            <h3>Recent posts send to buffer</h3>
        </div>
        <div class="panel-body">
            <form action="{{url("history")}}" method="get">
                <div class="row">
                    <div class="form-group col-sm-3">
                        <input type="text" name="search" value="{{request()->input('search')}}" class="form-control" placeholder="search">
                    </div>
                    <div class="form-group col-sm-3">
                        <input type="text" name="date" value="{{request()->input('date')}}" class="form-control" placeholder="date">
                    </div>    
                    <div class="form-group col-sm-3">
                        <select name="group" class="form-control">
                            <option value="">Group</option>
                            @foreach ($groups as  $group)
                                <option value="{{$group->id}}" @if(request()->input('group') == $group->id) selected @endif>{{$group->name}}</option>                                
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group col-sm-3">
                        <input type="submit" value="submit" class="btn btn-default">
                    </div>
                </div>
            </form>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Group Name</th>
                    <th>Group Type</th>
                    <th>Account name</th>
                    <th>Post Text</th>
                    <th>Time</th>
                </tr>
                @foreach ($BufferPosting as $post)
                    <tr>
                        <td>@if($post->groupInfo){{$post->groupInfo->name}}@endif</td>
                        <td>@if($post->groupInfo){{$post->groupInfo->type}}@endif</td>
                        <td>
                            @if($post->accountInfo)
                            <img src="{{$post->accountInfo->avatar}}" width="40" class="circle" alt="">
                            @endif
                        </td>
                        
                    <td>{{$post->post_text}}</td>
                    <td>{{date("d M Y", strtotime($post->sent_at))}} | @if($post->accountInfo){{ $post->accountInfo->timezone}}@endif</td>
                    </tr>
                @endforeach
            </table>

            @if(request()->has("search"))
            {{ $BufferPosting->appends(['search' => request()->input('search')])->links() }}
            @elseif(request()->has("date"))
            {{ $BufferPosting->appends(['date' => request()->input('date')])->links() }}
            @elseif(request()->has("group"))
            {{ $BufferPosting->appends(['group' => request()->input('group')])->links() }}
            @else
            {{ $BufferPosting->links() }}
            @endif
        </div>
    </div>
</div>
@endsection