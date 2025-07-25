<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="d-flex">
            <div>
                {{-- <img src="{{ asset('backend') }}/assets/images/logo.svg" class="logo-icon" alt="logo icon"> --}}
            </div>
            <div>
                <h4 class="logo-text">Glowthentic</h4>
            </div>
        </a>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu mb-5" id="menu">

        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        {{-- Ecommerce store Related menu  --}}
        <li class="menu-label">Manage Store</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-store"></i></div>
                <div class="menu-title">Manage Store</div>
            </a>
            <ul class="mm-collapse">
                {{-- Product Related menu --}}
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-package'></i></div>
                        <div class="menu-title">Manage Products</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('product.view') }}"><i class="bx bx-list-ul"></i>All Products</a>
                        </li>
                        <li>
                            <a href="{{ route('product') }}"><i class="bx bx-plus-circle"></i>Add Product</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class='bx bx-category-alt'></i></div>
                        <div class="menu-title">Shop By Category</div>
                    </a>
                    <ul class="mm-collapse">
                        <li>
                            <a href="{{ route('category') }}"><i class="bx bx-plus-circle"></i>Manage Category</a>
                        </li>
                    </ul>
                </li>

                {{-- Brand Related menu --}}
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-bookmark-alt'></i></div>
                        <div class="menu-title">Manage Brands</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('brand') }}"><i class="bx bx-plus-circle"></i>Add Brand</a>
                        </li>
                        <li>
                            <a href="{{ route('brand.view') }}"><i class="bx bx-list-ul"></i>Manage Brand</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-ruler'></i></div>
                        <div class="menu-title">Manage Size</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('size.view') }}"><i class="bx bx-list-ul"></i>Size</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-palette'></i></div>
                        <div class="menu-title">Manage Color</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('color.view') }}"><i class="bx bx-list-ul"></i>Color</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-star'></i></div>
                        <div class="menu-title">Manage Features</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('product.feature.index') }}"><i class="bx bx-plus-circle"></i>Add
                                Feature</a>
                        </li>
                        <li>
                            <a href="{{ route('feature.view') }}"><i class="bx bx-list-ul"></i>Manage Features</a>
                        </li>
                    </ul>
                </li>

                {{-- Tag menu --}}
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-purchase-tag-alt'></i></div>
                        <div class="menu-title">Product Tag</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('tagname') }}"><i class="bx bx-plus-circle"></i>Add Tag</a>
                        </li>
                        <li>
                            <a href="{{ route('tagname.view') }}"><i class="bx bx-list-ul"></i>Manage Tags</a>
                        </li>
                    </ul>
                </li>

                {{-- Care By Concern --}}
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-heart'></i></div>
                        <div class="menu-title">Care By Concern</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('concern') }}"><i class="bx bx-plus-circle"></i>Add Concern</a>
                        </li>
                        <li>
                            <a href="{{ route('concern.view') }}"><i class="bx bx-list-ul"></i>Manage Concern</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>


        {{-- //////////////////////company related menu/////////////////////// --}}
        {{-- <li class="menu-label">Company Manage</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class='bx bx-message-rounded-dots'></i>
                </div>
                <div class="menu-title">Company Details</div>
            </a>
            <ul>

                <li> <a href="{{ route('company-details') }}"><i class="bx bx-right-arrow-alt"></i>Add Company</a>
                </li>
                <li> <a href="{{ route('company-details.view') }}"><i class="bx bx-right-arrow-alt"></i>Manage
                        Company</a>
                </li>
            </ul>
        </li> --}}

        <li class="menu-label">Order Management</li>
        {{-- Order Related menu --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="menu-title">Order <span
                        class="
                    badge bg-primary">{{ $new_orders ?? '' }}</span></div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('new.order') }}"><i class="bx bx-right-arrow-alt"></i>New Order</a>
                </li>
                <li>
                    <a href="{{ route('order.confirmed') }}"><i class="bx bx-right-arrow-alt"></i>Confirmed Order</a>
                </li>
                <li>
                    <a href="{{ route('order.processed') }}"><i class="bx bx-right-arrow-alt"></i>Processed Order</a>
                </li>


                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="">
                            <i class="fas fa-bell"></i>
                        </div>
                        <div class="menu-title">Delivering Order </div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('order.delivering') }}"><i class="bx bx-right-arrow-alt"></i>Shipping
                                Order</a>
                        </li>
                        <li>
                            <a href="{{ route('order.transit') }}"><i class="bx bx-right-arrow-alt"></i>In Transit
                                Order</a>
                        </li>

                        {{-- <li>
                            <a href="{{ route('order.delivered') }}"><i class="bx bx-right-arrow-alt"></i>Completed
                                Order</a>
                        </li> --}}
                    </ul>


                </li>



                <li>
                    <a href="{{ route('order.delivered') }}"><i class="bx bx-right-arrow-alt"></i>Completed
                        Order</a>
                </li>
                {{-- <li>
                    <a href="{{ route('order.refunding') }}"><i class="bx bx-right-arrow-alt"></i>Refunding
                        Orders</a>
                </li>
                <li>
                    <a href="{{ route('order.refunded') }}"><i class="bx bx-right-arrow-alt"></i>Refunded Orders</a>
                </li>
                <li>
                    <a href="{{ route('order.canceled') }}"><i class="bx bx-right-arrow-alt"></i>Canceled Orders</a>
                </li> --}}
                <li>
                    <a href="{{ route('order.denied') }}"><i class="bx bx-right-arrow-alt"></i>Denied Orders</a>
                </li>

                <li>
                    <a href="{{ route('custom.order.create') }}"><i class="bx bx-right-arrow-alt"></i>Custom Order
                        Create</a>
                </li>
            </ul>
        </li>



        <li class="menu-label">Banner Manage</li>
        @if (Auth::user()->email != 'asad@sobrokom.store')
            {{-- popup menu  --}}
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class='bx bx-message-rounded-dots'></i>
                    </div>
                    <div class="menu-title">Popup Message</div>
                </a>
                <ul>

                    <li> <a href="{{ route('popupMessage') }}"><i class="bx bx-right-arrow-alt"></i>Add Popup
                            Message</a>
                    </li>
                    <li> <a href="{{ route('popupMessage.view') }}"><i class="bx bx-right-arrow-alt"></i>Manage Popup
                            Message</a>
                    </li>
                </ul>
            </li>
            {{-- Home Banner menu  --}}
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class='bx bx-image-alt'></i>
                    </div>
                    <div class="menu-title">Home Banner</div>
                </a>
                <ul>
                    <li> <a href="{{ route('banner') }}"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>
                    </li>
                    <li> <a href="{{ route('banner.view') }}"><i class="bx bx-right-arrow-alt"></i>Manage Banner</a>
                    </li>
                </ul>
            </li>
            {{-- Offer Banner menu  --}}
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class='bx bx-image-alt'></i>
                    </div>
                    <div class="menu-title">Offer Banner </div>
                </a>
                <ul>
                    <li> <a href="{{ route('offerbanner') }}"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>
                    </li>
                    <li> <a href="{{ route('offerbanner.view') }}"><i class="bx bx-right-arrow-alt"></i>Manage
                            Banner</a>
                    </li>
                </ul>
            </li>



            {{-- courier --}}

            <li class="menu-label">Courier Manage</li>
            {{-- courier --}}
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class='bx bx-image-alt'></i>
                    </div>
                    <div class="menu-title">Courier Manage</div>
                </a>
                <ul>
                    <li> <a href="{{ route('Courier.Manage.steadfast.order') }}"><i
                                class="bx bx-right-arrow-alt"></i>Steadfast Order</a>
                    </li>
                    {{-- <li> <a href="{{ route('offerbanner.view') }}"><i class="bx bx-right-arrow-alt"></i>Manage
                            Banner</a>
                    </li> --}}
                </ul>
            </li>
            {{-- Subscriber list  --}}

            {{-- Coupon --}}
            {{-- <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="menu-title">Global Coupon</div>
                </a>
                <ul>
                    <li> <a href="{{ route('global.coupon') }}"><i class="bx bx-right-arrow-alt"></i>Add Global
                            Coupon</a>
                    </li>
                </ul>
            </li> --}}
            <li class="menu-label">Stock Manage</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="menu-title">Stock Management</div>
                </a>
                <ul>
                    <li> <a href="{{ route('product.stock.manage') }}"><i class="bx bx-right-arrow-alt"></i>Product
                            Stock</a>
                    </li>
                    <li>
                        <a href="{{ route('stock.view') }}"><i class="bx bx-right-arrow-alt"></i>View Stock</a>
                    </li>
                </ul>
            </li>

            <li class="menu-label">Blog Manage</li>
            {{-- //Manege Blog Start --}}
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="fab fa-blogger"></i>
                    </div>
                    <div class="menu-title">Manage Blog</div>
                </a>
                <ul class="mm-collapse">
                    {{-- //Blog Category --}}
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon">
                                <i class="fab fa-slack"></i>
                            </div>
                            <div class="menu-title">Blog Category</div>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route('blog.category.view') }}"><i class="bx bx-right-arrow-alt"></i>Add
                                    Blog
                                    Category</a>
                            </li>
                            <li>
                                <a href="{{ route('blog.all.category.view') }}"><i
                                        class="bx bx-right-arrow-alt"></i>Manage Blog
                                    Category</a>
                            </li>
                        </ul>
                    </li>

                    {{-- //Blog post --}}
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon">
                                <i class="fas fa-blog"></i>
                            </div>
                            <div class="menu-title">Blog Post</div>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route('blog.post.add.view') }}"><i class="bx bx-right-arrow-alt"></i>Add
                                    Blog</a>
                            </li>
                            <li>
                                <a href="{{ route('blog.all.post.view') }}"><i
                                        class="bx bx-right-arrow-alt"></i>Manage
                                    Blog</a>
                            </li>
                        </ul>
                    </li>
                    {{-- //Blog Comment --}}
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon">
                                <i class="far fa-comment"></i>
                            </div>
                            <div class="menu-title">Blog Comment</div>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route('blog.all.pending.comment') }}"><i
                                        class="bx bx-right-arrow-alt"></i>Pending
                                    Comment</a>
                            </li>
                            <li>
                                <a href="{{ route('blog.all.approved.comment') }}"><i
                                        class="bx bx-right-arrow-alt"></i>Approve
                                    Comment</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            {{-- //Blog Manage End --}}




            <li class="menu-label">User Manage</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="menu-title">Contact Messages</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('contact-message.show') }}"><i class="bx bx-right-arrow-alt"></i>View New
                            Message</a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="menu-title">User Tracker <span
                            class="
                    badge bg-primary">{{ $visitors ?? '' }}</span></div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('user-tracker.show') }}"><i class="bx bx-right-arrow-alt"></i>View Online
                            User</a>
                    </li>

                </ul>
            </li>
            {{-- All Users Information --}}
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class='bx bx-user'></i>
                    </div>
                    <div class="menu-title">Users</div>
                </a>
                <ul>
                    <li> <a href="{{ route('all.users') }}"><i class="bx bx-right-arrow-alt"></i>Manage
                            Users</a>
                    </li>
                </ul>
            </li>
        @endif
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class='bx bx-user'></i>
                </div>
                <div class="menu-title">Marketing</div>
            </a>
            <ul>
                <li> <a href="{{ route('sms.page') }}"><i class="bx bx-right-arrow-alt"></i>SMS Marketing</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="menu-title">Subscriber <span
                        class="
                badge bg-primary">{{ $subscribers ?? '' }}</span></div>
            </a>
            <ul>
                <li> <a href="{{ route('subscribe.view') }}"><i class="bx bx-right-arrow-alt"></i>Subscriber
                        list</a>
                </li>
            </ul>
        </li>











        <li class="menu-label">Coupon & Combo Manage</li>


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class='bx bx-user'></i>
                </div>
                <div class="menu-title">Combo Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('combo.index') }}"><i class="bx bx-right-arrow-alt"></i>Combo</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class='bx bx-user'></i>
                </div>
                <div class="menu-title">Combo Product Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('combo.product.index') }}"><i class="bx bx-right-arrow-alt"></i>Combo
                        Product</a>
                </li>
            </ul>
        </li>


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="menu-title">Manage Coupon</div>
            </a>
            <ul>

                <li> <a href="{{ route('Coupon.index') }}"><i class="bx bx-right-arrow-alt"></i>Coupon</a>
                </li>

            </ul>
        </li>


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class='bx bx-purchase-tag-alt'></i>

                </div>
                <div class="menu-title">Manage Product Promotion</div>
            </a>
            <ul>
                <li> <a href="{{ route('product.promotion.index') }}"><i class="bx bx-right-arrow-alt"></i>Product
                        Promotion</a>
                </li>

            </ul>
        </li>

        <li class="menu-label">Report and Issue</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class='bx bx-cog'></i>
                </div>
                <div class="menu-title">Report</div>
            </a>
            <ul>
                <li> <a href="{{ route('report') }}"><i class="bx bx-right-arrow-alt"></i>Manage Report and Issue</a>
                </li>
                <li> <a href="{{ route('report.insert') }}"><i class="bx bx-right-arrow-alt"></i>Add Report and
                        Issue</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Seetings</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class='bx bx-cog'></i>
                </div>
                <div class="menu-title">Settings</div>
            </a>
            <ul>
                <li> <a href="{{ route('settings') }}"><i class="bx bx-right-arrow-alt"></i>Category Settings</a>
                </li>

            </ul>
        </li>

        <li class="menu-label">Backup and Restore</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class='bx bx-cog'></i>
                </div>
                <div class="menu-title">Backup and Restore</div>
            </a>
            <ul>
                <li> <a href="{{ route('trash.index') }}"><i class="bx bx-right-arrow-alt"></i>Trash Bin</a>
                </li>
            </ul>
        </li>


    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
