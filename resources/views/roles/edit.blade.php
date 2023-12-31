@extends('layouts.frontend')
@section('content')
    <div class="row py-4">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>แก้ไขบทบาท</h2>
            </div>
            <div class="pull-right">
                <a href="{{ route('roles.index') }}" class="btn btn-primary">กลับ</a>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>วุ้ววววว</strong> มีบางอย่างผิดพลาด <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>รายการ</strong>
                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>สิทธิ์การเข้าใช้งาน: </strong>
                <br>
                @foreach ($permission as $value)
                    <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                        {{ $value->name }}</label>
                    <br>
                @endforeach
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">บันทึก</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
