<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-soft-primary">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p>Sign in to continue to Skote.</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="@/assets/images/profile-img.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0"> 
                        <div>
                            <a href="index.html">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="@/assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                                    </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            <form class="form-horizontal" action="index.html">
                                <div class="form-group">
                                    <label for="username" class="text-capitalize"> {{ $t('USERNAME') }} </label>
                                    <input type="text" class="form-control" id="username" :placeholder="$t('ENTER_USERNAME')">
                                </div>
        
                                <div class="form-group">
                                    <label for="userpassword" class="text-capitalize">{{ $t('PASSWORD') }}</label>
                                    <input type="password" class="form-control" id="userpassword" :placeholder="$t('ENTER_PASSWORD')">
                                </div>
        
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customControlInline">
                                    <label class="custom-control-label" for="customControlInline">{{ $t('REMEMBER_ME') }}</label>
                                </div>
                                
                                <div class="mt-3">
                                    <button class="btn btn-primary btn-block waves-effect waves-light w-100" type="submit">{{$t('LOG_IN')}}</button>
                                </div>
    
                                <div class="mt-4 text-center">
                                    <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock me-1"></i>{{$t('FORGOT_YOUR_PASSWORD')}}</a>
                                </div>
                            </form>
                        </div>
                        <div class="p-2 d-flex align-items-center">
                            <div class="form-group signup-link">
                                <a href="#" class="google-signup wave-effect" @click.prevent="signUpWithGoogle">
                                    <img src="@/assets/images/brands/icons8-google.svg" alt="">
                                    Google
                                </a>
                            </div>
                            <div class="form-group signup-link">
                                <a href="#" class="fb-signup">
                                    <img src="@/assets/images/brands/icons8-facebook.svg" alt="">
                                    Facebook
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <p>Don't have an account ? <a href="auth-register.html" class="font-weight-medium text-primary"> Signup now </a> </p>
                    <p>© 2020 Skote. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                </div>

            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
    definePageMeta({
        layout: 'authenticate'
    })

    // event on click sign up with Google
    const signUpWithGoogle = () => {
        alert(132);
    }
</script>