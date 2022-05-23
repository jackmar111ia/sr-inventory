<div class="sidebar-container">
 				<div class="sidemenu-container navbar-collapse collapse fixed-menu">
	                <div id="remove-scroll">
	                    <ul class="sidemenu page-header-fixed p-t-20" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
	                        <li class="sidebar-toggler-wrapper hide">
	                            <div class="sidebar-toggler">
	                                <span></span>
	                            </div>
	                        </li>
	                        <li class="sidebar-user-panel">
                            <div class="user-panel">
                               
                              <div class="profile-usertitle">
                                  <div class="sidebar-userpic-name"> {{ Auth::user()->name}}</div>
                                  <div class="profile-usertitle-job"> Moderator </div>
                              </div>
                              <?php /*
                              <div class="sidebar-userpic-btn">
                                <a class="tooltips" href="user_profile.html" data-placement="top" data-original-title="Profile">
                                  <i class="material-icons">person_outline</i>
                                </a>
                                <a class="tooltips" href="email_inbox.html" data-placement="top" data-original-title="Mail">
                                  <i class="material-icons">mail_outline</i>
                                </a>
                                <a class="tooltips" href="chat.html" data-placement="top" data-original-title="Chat">
                                  <i class="material-icons">chat</i>
                                </a>
                                <a class="tooltips" href="login.html" data-placement="top" data-original-title="Logout">
                                  <i class="material-icons">input</i>
                                </a>
                              </div>
                              */ ?>
                            </div>
	                        </li>
	                        
	                       
                            @include('moderator.includes.dynamicNav')
                            <li class="nav-item">
	                            <a href="{{ url('moderator/logout') }}" class="nav-link nav-toggle"> <i class="material-icons">widgets</i>
	                                <span class="title">Log Out</span> 
	                            </a>
	                          </li>
	                            </ul>
	                        </li>
	                    </ul>
	                </div>
                </div>
            </div>
