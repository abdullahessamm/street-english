@extends('coach.layouts.app',[
    'title' => 'حجز باسم : soheil@gmail.com',
    'scripts' => 'pages.my-session.index'
])

@section('content')
<div class="page-section">
    <div class="container page__container">

        <div class="row">
            <div class="col-lg-8">
                
                <div class="page-separator">
                    <div class="page-separator__text">بيانات العميل</div>
                </div>
                
                <table class="table">
                    <tbody>
                        <tr>
                            <td>اسم العميل</td>
                            <td>سهيل صلاح</td>
                        </tr>

                        <tr>
                            <td>ايميل العميل</td>
                            <td>soheil@gmail.com</td>
                        </tr>

                        <tr>
                            <td>قام بالحجز في تاريخ</td>
                            <td>1/1/1998</td>
                        </tr>

                        <tr>
                            <td>رقم هاتف العميل</td>
                            <td>
                                <a href="" class="text-info" dir="ltr">+201012219274</a>
                            </td>
                        </tr>

                        <tr>
                            <td>قام بحجز ميعاد</td>
                            <td>
                                من 1:00 مساء الي 2:00 مساء بتاريخ 12/12/1997
                            </td>
                        </tr>

                        <tr>
                            <td>هل العميل طالب لديك</td>
                            <td>
                                <p class="text-success">نعم</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                @include('coach.includes.my-account',[
                    'title' => 'جلساتي',
                    'active' => 'coach.my-sessions'
                ])

                <div class="card">
                    <div class="card-header text-center">
                        <a href="#"
                           class="btn btn-accent">الغاء الميعاد</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection