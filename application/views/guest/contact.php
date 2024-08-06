@extends('theme.guest')

@section('title', 'Recommendation')

@section('content')
<div class="hero" style="background-image: url('<?= base_url('assets/template_guest/') ?>images/bike8.jpg');">

	<div class="container">
		<div class="row align-items-center justify-content-center">
			<div class="col-lg-10">

				<div class="row mb-5">
					<div class="col-lg-7 intro">
						<h1><strong>Contact</strong> Us</h1>
					</div>
				</div>

				

			</div>
		</div>
	</div>
</div>
<div class="site-section bg-light" id="contact-section">
      <div class="container">
        <div class="row justify-content-center text-center">
        <div class="col-7 text-center mb-5">
          <h2>Hubungi Kami</h2>
          <p>Berikan kritik & saran kamu dengan mengisi form dibawah ini!</p>
        </div>
      </div>
        <div class="row">
          <div class="col-lg-8 mb-5" >
            <form action="#" method="post">
              <div class="form-group row">
                <div class="col-md-6 mb-4 mb-lg-0">
                  <input type="text" class="form-control" placeholder="First name">
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Last name">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <input type="text" class="form-control" placeholder="Email address">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <textarea name="" id="" class="form-control" placeholder="Write your message." cols="30" rows="10"></textarea>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6 mr-auto">
                  <input type="submit" class="btn btn-block btn-primary text-white py-3 px-5" value="Send Message">
                </div>
              </div>
            </form>
          </div>
          <div class="col-lg-4 ml-auto">
            <div class="bg-white p-3 p-md-5">
              <h3 class="text-black mb-4">Contact Info</h3>
              <ul class="list-unstyled footer-link">
                <li class="d-block mb-3">
                  <span class="d-block text-black">Address:</span>
                  <span>Perumahan Canggu Pertiwi 1 No.5, Br.Tandeg, Kuta Utara</span></li>
                <li class="d-block mb-3"><span class="d-block text-black">Phone:</span><a href="tel://08970274763">+62 089 70274763</a></li>
                <li class="d-block mb-3"><span class="d-block text-black">Email:</span><a href="mailto:info@mydomain.com">bike_idea@gmail.com</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>







</div>

@endsection

@section('url')

@endsection

@section('script')

@endsection
