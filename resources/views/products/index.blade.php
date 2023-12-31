@extends('layouts.frontend')
@section('title', 'รายการสินค้าทั้งหมด')
{{-- @section('css_before') --}}
@section('content')
    <section class="py-5 container">
        <div class="row py-lg-5">
            <div class="col-lg-12 mx-auto">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ภาพสินค้า</th>
                            <th scope="col">ชื่อสินค้า</th>
                            <th scope="col">ราคา</th>
                            {{-- <th scope="col">จัดการ</th> --}}
                            <th scope="col" colspan="2">จัดการ</th>
                        </tr>
                    </thead>
                    @foreach ($products as $product)
                        <tbody>
                            <tr>
                                <td scope="col">{{ $product->id }}</td>
                                <td scope="col">
                                    <img src="{{ asset('uploads/resize/' . $product->image) }}" style="width:50px"
                                        class="img-size" />
                                </td>
                                <td scope="col">{{ $product->name }}</td>
                                <td scope="col" style="width:20%">{{ number_format($product->price, 2) }} ฿</td>
                                <td scope="col">
                                    <a href="" class="btn btn-info btn-sm">ดูรายละเอียด</a>
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="btn btn-warning btn-sm">แก้ไข</a>
                                    <a href="{{ route('products.destroy', $product->id) }}" class="btn btn-danger btn-sm"
                                        onclick="return confirm('ยืนยันการลบหรือไม่')">ลบ</a>

                                    {{-- Destroy Form --}}
                                    {{-- {!! Form::open([
                                        'route' => ['products.destroy', $product->id],
                                        'method' => 'DELETE',
                                    ]) !!}
                                    {!! Form::submit('ลบข้อมูล', [
                                        'class' => 'btn btn-danger btn-sm',
                                        'onclick' => "return confirm('ยืนยันการลบหรือไม่')",
                                    ]) !!}
                                    {!! Form::close() !!} --}}


                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </section>
@endsection
{{-- @section('js_before')
<script type="text/javascript">
    
</script> --}}
