<div class="box-filter">
    <div class="b-head">
        <h2>newest courses</h2>
        <a href="{{route('all_courses')}}">view all</a>
    </div>
    <div class="posts">

        @include('front::layouts.latestCourses')




    </div>
    <style>
        /* --- Testimonials --- */
        .testimonials {
            background: #f4f5f7;
            padding: 50px 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .testimonial-card {
            background: #fff;
            border-radius: 15px;
            padding: 30px 20px;
            width: 300px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s;
        }

        .testimonial-card:hover {
            transform: translateY(-8px);
        }

        .testimonial-card p {
            font-size: 14px;
            color: #555;
            margin-bottom: 15px;
        }

        .testimonial-card span {
            font-weight: bold;
            color: #1e90ff;
        }

        /* --- Popular Categories --- */
        .popular-categories {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 25px;
            padding: 40px 20px;
        }

        .category-card {
            background: #fff;
            padding: 20px 15px;
            border-radius: 15px;
            text-align: center;
            width: 150px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s;
        }

        .category-card:hover {
            transform: translateY(-5px);
        }

        .category-card img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        /* --- Blog / Tips Section --- */
        .blog-section {
            padding: 50px 20px;
            background: #fff;
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
        }

        .blog-card {
            background: #f4f5f7;
            border-radius: 15px;
            width: 300px;
            overflow: hidden;
            transition: transform 0.3s;
        }

        .blog-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .blog-card h4 {
            margin: 15px;
            font-size: 18px;
        }

        .blog-card p {
            margin: 0 15px 15px;
            font-size: 14px;
            color: #555;
        }

        /* --- CTA Section --- */
        .cta-section {
            background: #1e90ff;
            color: #fff;
            text-align: center;
            padding: 50px 20px;
            border-radius: 15px;
            margin: 40px 20px;
        }

        .cta-section h2 {
            margin-bottom: 20px;
            font-size: 36px;
        }

        .cta-section a {
            display: inline-block;
            padding: 12px 30px;
            background: #fff;
            color: #1e90ff;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.3s, transform 0.3s;
        }

        .cta-section a:hover {
            background: #f4f5f7;
            transform: translateY(-3px);
        }
        </style>

        <!-- --- Testimonials --- -->
        <div class="testimonials">
            <div class="testimonial-card">
                <p>"This platform helped me land a new job in web development!"</p>
                <span>- Sarah J.</span>
            </div>
            <div class="testimonial-card">
                <p>"High quality courses and excellent teachers. Highly recommended."</p>
                <span>- Michael R.</span>
            </div>
            <div class="testimonial-card">
                <p>"I love learning at my own pace. This is the best online platform."</p>
                <span>- Emily W.</span>
            </div>
        </div>



        <!-- --- Call to Action --- -->
        <div class="cta-section">
            <h2>Join 20,000+ Students Today!</h2>
            <a href="/courses">Explore All Courses</a>
        </div>



</div>
