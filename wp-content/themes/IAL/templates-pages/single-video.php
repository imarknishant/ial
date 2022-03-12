<?php

/* Template Name: Single video */
get_header();
?>

<main id="Main" class="sigle-video-wrap ">
           <section class="single-video-wrap">
                <div class="single-video-left">
                    <div class='player-container'>
                        <div class='player'>
                           <video id='video' src='<?php echo get_template_directory_uri(); ?>/assets/video/video-1.mp4' autoplay playsinline></video>
                           <div class='play-btn-big'></div>
                           <div class='controls'>
                              <div class="time"><span class="time-current"></span><span class="time-total"></span></div>
                              <div class='progress'>
                                 <div class='progress-filled'></div>
                              </div>
                              <div class='controls-main'>
                                 <div class='controls-left'>
                                    <div class='volume'>
                                       <div class='volume-btn loud'>
                                          <svg width="26" height="24" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M6.75497 17.6928H2C0.89543 17.6928 0 16.7973 0 15.6928V8.30611C0 7.20152 0.895431 6.30611 2 6.30611H6.75504L13.9555 0.237289C14.6058 -0.310807 15.6 0.151473 15.6 1.00191V22.997C15.6 23.8475 14.6058 24.3098 13.9555 23.7617L6.75497 17.6928Z" transform="translate(0 0.000518799)" fill="white"/>
                                             <path id="volume-low" d="M0 9.87787C2.87188 9.87787 5.2 7.66663 5.2 4.93893C5.2 2.21124 2.87188 0 0 0V2C1.86563 2 3.2 3.41162 3.2 4.93893C3.2 6.46625 1.86563 7.87787 0 7.87787V9.87787Z" transform="translate(17.3333 7.44955)" fill="white"/>
                                             <path id="volume-high" d="M0 16.4631C4.78647 16.4631 8.66667 12.7777 8.66667 8.23157C8.66667 3.68539 4.78647 0 0 0V2C3.78022 2 6.66667 4.88577 6.66667 8.23157C6.66667 11.5773 3.78022 14.4631 0 14.4631V16.4631Z" transform="translate(17.3333 4.15689)" fill="white"/>
                                             <path id="volume-off" d="M1.22565 0L0 1.16412L3.06413 4.0744L0 6.98471L1.22565 8.14883L4.28978 5.23853L7.35391 8.14883L8.57956 6.98471L5.51544 4.0744L8.57956 1.16412L7.35391 0L4.28978 2.91031L1.22565 0Z" transform="translate(17.3769 8.31403)" fill="white"/>
                                          </svg>
                                       </div>
                                       <div class='volume-slider'>
                                          <div class='volume-filled'></div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class='play-btn paused'></div>
                                 <div class="controls-right">
                                    <div class='speed'>
                                       <ul class='speed-list'>
                                          <li class='speed-item' data-speed='0.5'>0.5x</li>
                                          <li class='speed-item' data-speed='0.75'>0.75x</li>
                                          <li class='speed-item' data-speed='1' class='active'>1x</li>
                                          <li class='speed-item' data-speed='1.5'>1.5x</li>
                                          <li class='speed-item' data-speed='2'>2x</li>
                                       </ul>
                                    </div>
                                    <div class='fullscreen'>
                                       <svg width="30" height="22" viewBox="0 0 30 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M0 0V-1.5H-1.5V0H0ZM0 18H-1.5V19.5H0V18ZM26 18V19.5H27.5V18H26ZM26 0H27.5V-1.5H26V0ZM1.5 6.54545V0H-1.5V6.54545H1.5ZM0 1.5H10.1111V-1.5H0V1.5ZM-1.5 11.4545V18H1.5V11.4545H-1.5ZM0 19.5H10.1111V16.5H0V19.5ZM24.5 11.4545V18H27.5V11.4545H24.5ZM26 16.5H15.8889V19.5H26V16.5ZM27.5 6.54545V0H24.5V6.54545H27.5ZM26 -1.5H15.8889V1.5H26V-1.5Z" transform="translate(2 2)" fill="white"/>
                                       </svg>
                                       </svg>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="video-title-action">
                         <h6>There are many variations of passages of Lorem Ipsum available,
                            <em>109 Views  | 98 Votes  | Jan 4, 2021  </em>
                         </h6>
                         <div class="action_wrap">
                              <div class="action_left">
                                   <a href="#" class="ac-btn link-btn"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Like</a>
                                   <a href="#" class="ac-btn share-btn"><i class="fa fa-share" aria-hidden="true"></i> Share</a>
                              </div>
                              <div class="action_right">
                                <a href="#" class="vote-btn btn btn-default btn-sm ">VOTE</a>
                                <a href="#tip_modal" data-toggle="modal" class="tip-btn btn red-color btn-border btn-sm ">TIP</a>
                              </div>
                         </div>
                     </div>


                     <div class="channel_pro_box">
                         <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/avtar-img-1.png" alt="avtar-img-1.png" /></figure>
                         <div class="channel_pro_content">
                             <h6> 
                                Antonio
                                <a href="#" class="text-yellow">View Portfolio</a>
                                <a href="#" class="btn btn-red btn-sm">Follow</a>
                             </h6>

                             <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text.</p>
                         </div>
                     </div>

                     <div class="channel_comments">
                         <div class="channel_comments_form">
                               <form>
                                   <div class="form-group">
                                       <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/avtar-img-1.png" alt="avtar-img-1.png" /></figure>
                                       <div class="input_filed">
                                           <input type="text" class="form-control style_2" placeholder="Add comment here" />
                                           <p class="comnent-items"><strong>254 Comments</strong></p>
                                       </div>
                                   </div>
                               </form>
                         </div>

                         <div class="channel_coment_list">
                               <div class="cm_box">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/avtar-img-1.png" alt="avtar-img-1.png" /></figure>
                                    <div class="cm_content_box">
                                         <h6>Olivia</h6>
                                         <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                                         <a href="#" class="reply">Reply</a>
                                    </div>
                               </div>

                               <div class="cm_box">
                                <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/avtar-img-1.png" alt="avtar-img-1.png" /></figure>
                                <div class="cm_content_box">
                                     <h6>Olivia</h6>
                                     <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                                     <a href="#" class="reply">Reply</a>
                                </div>
                           </div>

                           <div class="cm_box">
                            <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/avtar-img-1.png" alt="avtar-img-1.png" /></figure>
                            <div class="cm_content_box">
                                 <h6>Olivia</h6>
                                 <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                                 <a href="#" class="reply">Reply</a>
                            </div>
                       </div>

                        <div class="cm_box">
                            <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/avtar-img-1.png" alt="avtar-img-1.png" /></figure>
                            <div class="cm_content_box">
                                <h6>Olivia</h6>
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                                <a href="#" class="reply">Reply</a>
                                </div>
                        </div>


                        <div class="cm_box">
                            <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/avtar-img-1.png" alt="avtar-img-1.png" /></figure>
                            <div class="cm_content_box">
                                <h6>Olivia</h6>
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                                <a href="#" class="reply">Reply</a>
                                </div>
                        </div>


                        <div class="cm_box">
                            <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/avtar-img-1.png" alt="avtar-img-1.png" /></figure>
                            <div class="cm_content_box">
                                <h6>Olivia</h6>
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                                <a href="#" class="reply">Reply</a>
                                </div>
                        </div>


                        <div class="cm_box">
                            <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/avtar-img-1.png" alt="avtar-img-1.png" /></figure>
                            <div class="cm_content_box">
                                <h6>Olivia</h6>
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                                <a href="#" class="reply">Reply</a>
                                </div>
                        </div>


                        <div class="cm_box">
                            <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/avtar-img-1.png" alt="avtar-img-1.png" /></figure>
                            <div class="cm_content_box">
                                <h6>Olivia</h6>
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                                <a href="#" class="reply">Reply</a>
                                </div>
                        </div>


                        <div class="cm_box">
                            <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/avtar-img-1.png" alt="avtar-img-1.png" /></figure>
                            <div class="cm_content_box">
                                <h6>Olivia</h6>
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                                <a href="#" class="reply">Reply</a>
                                </div>
                        </div>


                         </div>
                     </div>
                </div>

                <div class="single-video-right">
                    <div class="title">
                        <h6>Next Video</h6>
                        <div class="single-video-list">
                              <div class="single-video-box">
                                  <a href="#">
                                      <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                      <div class="single-video-content">
                                          <p>There are many variations of passages of Lorem Ipsum available,</p>
   
                                          <div class="single-video-sub-con">
                                              <p>Angel</p>
                                              <em>109 Views  |  4 days ago</em>
                                          </div>
                                      </div>
                                  </a>
                              </div>

                              <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="single-video-box">
                                <a href="#">
                                    <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/video-list-1.png" alt="video-list-1.png"></figure>
                                    <div class="single-video-content">
                                        <p>There are many variations of passages of Lorem Ipsum available,</p>
 
                                        <div class="single-video-sub-con">
                                            <p>Angel</p>
                                            <em>109 Views  |  4 days ago</em>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
           </section>
      </main>


<?php
get_footer();
?>
