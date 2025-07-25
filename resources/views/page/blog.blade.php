@extends('frontend.master')

@push('content')
<section id="page-header" class="blog-header" style="background-image: url('{{ asset('images/banner/b19.jpg') }}'); ">
    <h2>#readmore</h2>
    <p>Read all case studies about our products!</p>
</section>

<section id="blog">
    <div class="blog-box">
        <div class="blog-img">
            <img src="images/blog/b1.jpg" alt="">
        </div>
        <div class="blog-details">
            <h4>The Cotton-Jersey Zip-Up Hoodie</h4>
            <p>Kickstarter man braid godard coloring book. Raclette waistcoat selfies
                yr wolf chartreuse hexagon irony, godard...
            </p>
            <a href="#">CONTINUE READING</a>
        </div>
        <h1>13/01</h1>
    </div>
    <div class="blog-box">
        <div class="blog-img">
            <img src="images/blog/b2.jpg" alt="">
        </div>
        <div class="blog-details">
            <h4>How to Style a Quiff</h4>
            <p>Kickstarter man braid godard coloring book. Raclette waistcoat selfies
                yr wolf chartreuse hexagon irony, godard...
            </p>
            <a href="#">CONTINUE READING</a>
        </div>
        <h1>13/04</h1>
    </div>
    <div class="blog-box">
        <div class="blog-img">
            <img src="images/blog/b3.jpg" alt="">
        </div>
        <div class="blog-details">
            <h4>Must-Have Skater Girl Items</h4>
            <p>Kickstarter man braid godard coloring book. Raclette waistcoat selfies
                yr wolf chartreuse hexagon irony, godard...
            </p>
            <a href="#">CONTINUE READING</a>
        </div>
        <h1>12/01</h1>
    </div>
    <div class="blog-box">
        <div class="blog-img">
            <img src="images/blog/b4.jpg" alt="">
        </div>
        <div class="blog-details">
            <h4>Runway-Inspired Trends</h4>
            <p>Kickstarter man braid godard coloring book. Raclette waistcoat selfies
                yr wolf chartreuse hexagon irony, godard...
            </p>
            <a href="#">CONTINUE READING</a>
        </div>
        <h1>16/01</h1>
    </div>
    <div class="blog-box">
        <div class="blog-img">
            <img src="images/blog/b6.jpg" alt="">
        </div>
        <div class="blog-details">
            <h4>AW20 Menswear Trends</h4>
            <p>Kickstarter man braid godard coloring book. Raclette waistcoat selfies
                yr wolf chartreuse hexagon irony, godard...
            </p>
            <a href="#">CONTINUE READING</a>
        </div>
        <h1>10/03</h1>
    </div>
</section>

<section id="pagination" class="section-p1">
    <a href="#">1</a>
    <a href="#">2</a>
    <a href="#"><i class="fas fa-long-arrow-alt-right"></i></a>
</section>

<section id="newsletter" class="section-p1 section-m1">
    <div class="newstext">
        <h4>Sign Up For Newsletter</h4>
        <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>
    </div>
    <div class="form">
        <input type="text" placeholder="Your email address">
        <button class="normal">Sign Up</button>
    </div>
</section>
@endpush
