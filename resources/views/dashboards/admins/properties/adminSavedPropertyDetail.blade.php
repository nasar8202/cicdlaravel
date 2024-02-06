@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title', 'Saved Properties list')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1 class="main-heading">2066 Crist Drive</h1>
        </div>
    </div>
    <div class="detail-wrapper">
        <div class="row">
            <div class="col-lg-9">
                <div class="detail-inner">
                    <div class="listing-box">
                        <div class="list-img">
                            <img src="{{ URL::asset('assets/listbanner.png') }}" alt="" />
                        </div>
                        <div class="list-content list-content-detail">
                            <div class="room-spec">
                                <h3>3 <i class="fa fa-bed" aria-hidden="true"></i></h3>
                                <h3>3 <i class="fa fa-shower" aria-hidden="true"></i></h3>
                                <h3><i class="fa fa-arrows-v" aria-hidden="true"></i> 250 Sq.Yd.</h3>
                            </div>
                            <div class="price-fav">
                                <div class="hearts position-static">
                                    <!-- <i class="fa-regular fa-heart"></i> -->
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h1 class="main-heading">Overview</h1>

                    <div class="detail-table">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <td>Type</td>
                                            <td>House</td>
                                        </tr>
                                        <tr>
                                            <td>Price</td>
                                            <td>$50.000</td>
                                        </tr>
                                        <tr>
                                            <td>Location</td>
                                            <td>Abc location, Newyork</td>
                                        </tr>
                                        <tr>
                                            <td>Bath(s)</td>
                                            <td>4</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <td>Area</td>
                                            <td>3,150 sqft</td>
                                        </tr>
                                        <tr>
                                            <td>Purpose</td>
                                            <td>For sale</td>
                                        </tr>
                                        <tr>
                                            <td>Bedroom</td>
                                            <td>4</td>
                                        </tr>
                                        <tr>
                                            <td>Added</td>
                                            <td>2 hours ago</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <h1 class="main-heading">Description</h1>

                    <div class="detail-description">
                        <p>
                            Only one block from 2 Talwar, this pristine 5 bedroom plus office, 5 bathroom 350sq yards
                            house is available for sale. Upon entering you are welcomed into an expansive open
                            living space that flows into the dining area with oversized open windows and high beamed
                            ceilings, perfect for entertaining or relaxing.
                            <br /><br />
                            Just off the dining area is the kitchen installed with stainless steel appliances, sleek
                            countertops fitted with additional storage space,
                        </p>
                        <button>Read more <i class="fa-solid fa-chevron-down"></i></button>
                    </div>

                    <h1 class="main-heading">Location & Address</h1>

                    <div class="location-map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d3621.923814799016!2d67.0581505258346!3d24.798062147750738!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e0!4m3!3m2!1d24.7988224!2d67.05971199999999!4m5!1s0x3eb33cee2d7b417d%3A0x298ecae67eff124a!2sPhase%206!3m2!1d24.796000199999998!2d67.0613528!5e0!3m2!1sen!2s!4v1703252001335!5m2!1sen!2s"
                            width="100%" height="206" style="border: 0" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="detail-contact-info">
                    <h2>Contact Information</h2>
                    <div class="info-inner">
                        <p><i class="fa-solid fa-user"></i> Jane Dough</p>
                        <p><i class="fa-solid fa-envelope"></i> email@email.com</p>
                        <p><i class="fa-solid fa-phone"></i> 123-456-7890</p>
                    </div>
                    <form action="" method="post">
                        <div class="form-inner">
                            <textarea name="" id="" rows="4" class="form-control" placeholder="Type your message here"></textarea>
                        </div>
                        <button type="submit" class="primary-btn">Send Message Text</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
