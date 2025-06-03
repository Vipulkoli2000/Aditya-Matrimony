<?php if (isset($component)) { $__componentOriginal586923fd33be01a728ed95ac16e3596d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal586923fd33be01a728ed95ac16e3596d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.user_banner','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout.user_banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <style>
        /* Existing style for other 'a' tags styled as buttons */
        a.btn {
            background-color: #ff0000; /* Rose Red color */
            color: white !important; /* Ensure text color is white */
        }

        /* Page container styling */
        .min-vh-100 {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Modern font for the whole page */
        }

        /* Card styling for 3D effect and modern look */
        .card {
            width: 100%;
            max-width: 480px; /* Preserving original max-width */
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07); /* Enhanced 3D shadow */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden; /* Ensures content respects border-radius */
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15), 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 2.5rem; /* Increased padding */
        }

        /* Form elements styling */
        .form-label {
            font-weight: 600; /* Slightly bolder labels */
            color: #343a40 !important; /* Darker, more modern color, overriding inline styles */
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 10px; /* More pronounced rounding */
            border: 1px solid #d1d5db; /* Softer border color */
            padding: 0.85rem 1.1rem; /* Slightly more padding */
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.04); /* Softer inset shadow */
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: #007bff; /* Primary color focus */
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.04), 0 0 0 0.25rem rgba(0,123,255,.25); /* Bootstrap-like focus glow */
        }

        /* Primary button styling */
        .btn-primary {
            background-color: #007bff; /* Primary blue - can be changed to #ff0000 for consistency if needed */
            border: none;
            border-radius: 10px;
            padding: 0.85rem 1.5rem;
            font-weight: 600;
            text-transform: uppercase; /* Uppercase text for emphasis */
            letter-spacing: 0.05em; /* Slight letter spacing */
            color: white !important; /* Ensure text is white */
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.25), 0 3px 8px rgba(0,0,0,0.1); /* 3D shadow */
            transition: background-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #0069d9; /* Darker blue on hover */
            transform: translateY(-3px); /* Enhanced lift effect */
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3), 0 5px 12px rgba(0,0,0,0.15);
        }

        .btn-primary:active {
            transform: translateY(-1px); /* Press down effect */
            box-shadow: 0 3px 10px rgba(0, 123, 255, 0.2), 0 2px 5px rgba(0,0,0,0.1);
        }

        /* "Remember me" checkbox styling */
        .form-check {
            display: flex;
            align-items: center;
            margin-top: 0.5rem; /* Spacing above checkbox */
        }
        .form-check-input {
            margin-top: 0;
            margin-right: 0.6rem;
            width: 1.2em; /* Slightly larger checkbox */
            height: 1.2em;
            border-radius: 4px; /* Softly rounded checkbox */
            border: 1px solid #adb5bd;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: background-color 0.2s, border-color 0.2s;
        }
        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }
        .form-check-label {
            color: #495057 !important; /* Overriding inline styles */
            padding-top: 0.1em; /* Fine-tune vertical alignment */
            font-size: 0.9rem;
        }

        /* "Forgot password" link styling */
        .text-primary.font-weight-bold {
            color: #007bff !important;
            text-decoration: none;
            transition: color 0.2s ease, text-decoration 0.2s ease;
        }

        .text-primary.font-weight-bold:hover {
            color: #0056b3 !important;
            text-decoration: underline;
        }

        /* Headings and text styling */
        .card-body h2.font-weight-bold {
            color: #212529; /* Darker, standard heading color */
            font-size: 2rem; /* Larger heading */
            margin-bottom: 0.75rem !important; /* Adjusted spacing */
        }

        .card-body p.mb-4 { /* "Enter your Email or Mobile Number to login" */
            color: #6c757d; /* Softer text color */
            font-size: 1rem;
            margin-bottom: 2rem !important; /* More space before form */
        }

        /* Alert styling */
        .alert-success {
            background-color: #d1e7dd;
            border-color: #badbcc;
            color: #0f5132;
            border-radius: 8px; /* Consistent rounding */
            box-shadow: 0 3px 8px rgba(0,0,0,0.05);
        }
    </style>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card">
            <div class="card-body">
                <h2 class="font-weight-bold mb-3">Sign In</h2>
                <p class="mb-4">Enter your Email or Mobile Number to login</p>
                
                <?php if(Session::has('status')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Password has been set successfully.
                    </div>
                <?php endif; ?>
                <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email/Mobile</label>
                        <input id="email" name="email" type="text" class="form-control" value="<?php echo e(old('email')); ?>"
                               placeholder="Enter email or mobile number" required autofocus autocomplete="username" />
                        <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('email'),'class' => 'mt-2 small text-danger']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('email')),'class' => 'mt-2 small text-danger']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                    </div>
                      
                    <script>
                        // Wait for the DOM to be fully loaded
                        document.addEventListener("DOMContentLoaded", function() {
                          const inputField = document.getElementById("email");
                      
                          inputField.addEventListener("blur", function() {
                            let value = inputField.value.trim();
                      
                            // Check if the input starts with a digit and doesn't already have '+91'
                            // Also, ensure it doesn't look like an email (i.e., no '@' symbol)
                            if (value && /^[0-9]/.test(value) && !value.includes('@') && !value.startsWith('+91')) {
                              inputField.value = '+91' + value;
                            }
                          });
                        });
                    </script>
                      
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" name="password" type="password" class="form-control" placeholder="Enter Password" required autocomplete="current-password" />
                        <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('password'),'class' => 'mt-2 small text-danger']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('password')),'class' => 'mt-2 small text-danger']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                    </div>
                    <div class="mb-3 form-check">
                        <input id="remember_me" name="remember" type="checkbox" class="form-check-input" />
                        <label for="remember_me" class="form-check-label"><?php echo e(__('Remember me')); ?></label>
                    </div>
                    <button type="submit" class="btn text-white btn-primary w-100">SIGN IN</button>
                </form>
                <?php if(Route::has('password.request')): ?>
                    <p class="text-center my-4">
                        <a class="text-primary font-weight-bold" href="<?php echo e(route('password.request')); ?>">
                            <?php echo e(__('Forgot your password?')); ?>

                        </a>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal586923fd33be01a728ed95ac16e3596d)): ?>
<?php $attributes = $__attributesOriginal586923fd33be01a728ed95ac16e3596d; ?>
<?php unset($__attributesOriginal586923fd33be01a728ed95ac16e3596d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal586923fd33be01a728ed95ac16e3596d)): ?>
<?php $component = $__componentOriginal586923fd33be01a728ed95ac16e3596d; ?>
<?php unset($__componentOriginal586923fd33be01a728ed95ac16e3596d); ?>
<?php endif; ?>
<?php /**PATH D:\dir\Aditya Matrimony\resources\views/auth/login.blade.php ENDPATH**/ ?>