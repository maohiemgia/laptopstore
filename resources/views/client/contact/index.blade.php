@extends('client.master')

{{-- content --}}
@section('main-content')
    <!-- ================ contact section start ================= -->
    <section class="contact-section padding_top">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Liên hệ</h2>
                </div>
                <div class="col-lg-4">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>FPT Polytechnic, Hà Nội</h3>
                            <p>Đường Trịnh Văn Bô, Nam Từ Liêm, Hà Nội</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>
                                <a href="tel:0342737862" class="text-dark">
                                    0342 737 862
                                </a>
                            </h3>
                            <p>8 giờ sáng tới 10 giờ tối hằng ngày</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>vantuan.webdev@gmail.com</h3>
                            <p>Gửi email cho tôi bất cứ khi nào!</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-sm-block mt-3 mb-5 pb-4">
                <iframe id="map"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8638558814882!2d105.74459841538527!3d21.038132792833043!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b991d80fd5%3A0x53cefc99d6b0bf6f!2sFPT%20Polytechnic%20Hanoi!5e0!3m2!1sen!2s!4v1681285431745!5m2!1sen!2s"
                    width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection
