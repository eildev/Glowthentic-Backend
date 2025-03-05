<div class="tpshop__top ml-60">
    <div class="row">
        <div class="col-12">
            <div class="tptrack__product mb-40">
                <div class="tptrack__content">
                    <div class="tptrack__item d-flex mb-20">
                        <div class="tptrack__item-icon">
                            <i class="fal fa-lock"></i>
                        </div>
                        <div class="tptrack__item-content">
                            <h4 class="tptrack__item-title">Change Password</h4>
                            <p>You can change your password from here. Please enter your Old password and new password
                                here to change.</p>
                        </div>
                    </div>
                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')
                        <div class="tptrack__email mb-10">

                            <span><i class="fal fa-key"></i></span>
                            <input placeholder="Old Password" name="current_password" type="password"
                                autocomplete="current-password">
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="my-2 ms-4 text-danger" />

                        </div>
                        <div class="tptrack__email mb-10">

                            <span><i class="fal fa-key"></i></span>
                            <input id="update_password_password" name="password" type="password"
                                autocomplete="new-password" placeholder="New Password">
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="my-2 ms-4 text-danger" />

                        </div>
                        <div class="tptrack__email mb-10">

                            <span><i class="fal fa-key"></i></span>
                            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" placeholder="Confirm New Password">

                        </div>
                        <div class="tptrack__btn">
                            <button class="tptrack__submition tpsign__reg">Change Password<i
                                    class="fal fa-long-arrow-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
