<x-layout.user_banner>
    {{-- about start --}}
    {{!! $page->description!!}}    

    <div>
    <div class="" id="weddingAbout">
        <div class="position-absolute" style="top: px; right: 0;">
            <img src="{{asset('assets/images/tamp-bg-1.png')}}" alt="Aditya Matrimony, Dombivili" class="hands">
        </div>
        <div class="position-absolute" style="top: px; left: 0; transform: rotate(150deg);">
            <img src="{{asset('assets/images/tamp-bg-1.png')}}" alt="Aditya Matrimony, Dombivili" class="hands">
        </div>
        <div class="container position-relative py-5">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="mx-auto  mb-3 wow fadeInUp" data-wow-delay="0.1s" >
                                <h2 class="display-1 text-primary" style="margin-left: 35px; margin-top: 35px;">About Us</h2>
                            </div>
                            <div class="d-flex">
                                <div class="my-auto">
                                    <b><h1  style="font-weight: bold; font-size: 20px; ">Welcome to Aditya Matrimony !!!</h1></b>
                                    
                                <p1 style="color: black; margin-left: 30px;"> Aditya Matrimony is a community-driven organization dedicated to facilitating successful matrimonial alliances within the community. Established with the vision to preserve cultural heritage and strengthen bonds, we aim to provide a reliable and respectful platform for individuals and families looking for compatible life partners.</p1>
                                <br><br>
                                <p2 style="color: black; margin-left: 30px;"> Our mission is to make the process of finding a life partner simpler, more accessible, and culturally aligned with community values and traditions. We understand the importance of family and tradition in the community, and with this in mind, we ensure a personalized approach to matchmaking that respects the diverse aspirations, backgrounds, and preferences of individuals.</p2>
                                </div>
                            </div>
                            {{-- <a class="btn btn-primary btn-primary-outline-0 py-3 px-5 mt-4" href="#">Know More</a> --}}
                        </div>
                        <div class="col-lg-5 wow fadeInUp order-first order-md-last" data-wow-delay="0.3s">
                            <img src="{{asset('assets/images/aboutbanner.jpg')}}" alt="Aditya Matrimony, Dombivili" class="about-image" style="width: 400px; height: 400px;">
                        </div>
                        
                       
                       
                    </div>
                    {{-- {!! @@$about1->description !!} --}}
                </div>
            </div>
        </div>
    </div>
    {{-- about end --}}
    {{-- story start --}}

    <div class="container-fluid story position-relative py-5" id="weddingStory">
           
        <div class="container position-relative py-5">
            <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <h2 class="display-4">Success Stories</h2>
            </div>
            <div class="story-timeline">
                <div class="row wow fadeInUp" data-wow-delay="0.2s">
                    <div class="col-md-6 text-end border-0 border-top border-end border-secondary p-4">
                        <div class="d-inline-flex align-items-center h-100">
                            <img src="{{asset('assets/images/KundaliMatching.jpeg')}}" alt="Aditya Matrimony, Dombivili" class="about-image" style="width: 300px; height: 300px;">
                        </div>
                    </div>
                    <div class="col-md-6 border-start border-top border-secondary p-4 pe-0">
                        <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-4">
                            <h3 class="h4 mb-2 text-white" style="font-weight: bold;">What we do</h3>
                            {{-- <p class=" text-light mb-2" >01 Jan 2020</p>   --}}
                            <p style="text-size: 100px">
                                <span style="color: black; font-weight: bold;">Matrimonial Services:</span> We offer a trusted platform where individuals and families can register, create detailed profiles, and find matches based on specific criteria, including caste, education, profession, and more.
                            </p>
                            
                            <p style="text-size:100px"> <span style="color: black; font-weight: bold;">Event Organizing: </span>From marriage events to community gatherings, we organize regular meet-ups and matrimonial events where families can connect in person, fostering a sense of trust and mutual respect. </p>
                        </div>
                        
                    </div>
                </div>
                <div class="row flex-column-reverse flex-md-row wow fadeInUp" data-wow-delay="0.3s">
                    <div class="col-md-6 text-end border-end border-top border-secondary p-4 ps-0">
                        <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-4">
                            <h3 class="h4 mb-2 text-white" style="font-weight: bold;">Our Values</h3> 
                            {{-- <p class=" text-light mb-2" >01 Jan 2020</p> --}}
                            <p><span style="color: black; font-weight: bold;">Integrity & Trust:</span> We are committed to providing transparent and trustworthy services, ensuring that every member is treated with the utmost respect and privacy.</p>
                            <p><span style="color: black; font-weight: bold;">Cultural Preservation:</span> At Aditya Matrimony, we believe in upholding the rich traditions and values of the community, ensuring that matrimonial decisions reflect both modern aspirations and ancestral values.</p>
                            <p><span style="color: black; font-weight: bold;">Community Connection:</span> We foster a close-knit network where families can meet like-minded individuals who share common values, culture, and goals.</p>
                         </div>
                    </div>
                    <div class="col-md-6 border-start border-top border-secondary p-4">
                        <div class="d-inline-flex align-items-center h-100">
                            <img src="img/story-1.jpg" class="img-fluid w-100 img-border" alt="Aditya Matrimony">
                        </div>
                    </div>
                </div>
                <div class="row wow fadeInUp" data-wow-delay="0.4s">
                    <div class="col-md-6 text-end border-end border-top border-secondary p-4 ps-0">
                        <div class="d-inline-flex align-items-center h-100">
                            <img src="img/story-1.jpg" class="img-fluid w-100 img-border" alt="Aditya Matrimony">
                        </div>
                    </div>
                    <div class="col-md-6 border-start border-top border-secondary p-4 pe-0">
                        <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-4">
                            <h3 class="h4 mb-2 text-white" style="font-weight: bold;">Why Choose Us?</h3>
                            {{-- <p class=" text-light mb-2" >01 Jan 2020</p> --}}
                            <p><span style="color: black; font-weight: bold;">Personalized Matchmaking:</span> Unlike other platforms, we focus on understanding your unique preferences and family values, ensuring we find the most compatible partners for you.</p>
                            <p><span style="color: black; font-weight: bold;">Confidentiality:</span> We prioritize the privacy of your personal information, ensuring that all profiles are handled with confidentiality and respect.</p>
                            <p><span style="color: black; font-weight: bold;">Proven Success:</span> Over the years, Aditya Matrimony has helped many families successfully find life partners, making us a trusted name in the community.</p>
                        </div>
                    </div>
                </div>
                {{-- <div class="row flex-column-reverse flex-md-row wow fadeInUp" data-wow-delay="0.5s">
                    <div class="col-md-6 text-end border border-start-0 border-secondary p-4 ps-0">
                        <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-4">
                            <h3 class="h4 mb-2 text-white">Bride Vs Groom</h3>
                            <p class=" text-light mb-2" >01 Jan 2020</p>
                            <p class="m-0 fs-5">Text will come here Text will come here Text will come here Text will come here Text will come here .</p>
                        </div>
                    </div>
                    <div class="col-md-6 border border-end-0 border-secondary p-4">
                        <div class="d-inline-flex align-items-center h-100">
                            <img src="img/story-1.jpg" class="img-fluid w-100 img-border" alt="Aditya Matrimony">
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
    {{-- story end --}}

    

    
</x-layout.user_banner>
