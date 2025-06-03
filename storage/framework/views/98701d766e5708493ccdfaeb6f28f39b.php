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
    <p class="text-center mb-6 font-bold" style="font-size: 21px;">Privacy Policy</p>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="mb-4">This electronic website is being operated and owned by www.adityamatrimony.com This PRIVACY POLICY STATEMENT is made/published in the internet web site to protect the user's privacy and it is connected to our terms and conditions.</p>

            <p class="mb-4">A user/member, when he is entering our web site after accepting our full terms and conditions of www.adityamatrimony.com should provide the mandatory information, he has the option of not providing the information which is not mandatory. User/Member is solely responsible for maintaining confidentiality of the User Name/Identity and User Password and all activities and transmission/transactions performed by the User through his/her user identity/name and shall be solely responsible for carrying out any online or off-line transactions involving credit/debit cards or such other forms of instruments or documents for making such transactions. As such, while doing so any negligence of your act, www.adityamatrimony.com assumes no responsibility / liability for their improper use of information relating to such usage of credit/debit cards used by the subscriber online/offline.</p>

            <p class="mb-4">www.adityamatrimony.com is connected / link to service partners, such as servers/administrators. We may use your IP address and other information provided by like Email address, Contact name, User-created password, Address , Pin code, Telephone number or other contact number etc; to help diagnose problems with our server, and to manage our Web site. Your IP address may be also used to gather broad demographic information. And the information will be used by us to contact you and to deliver information to you that, in some cases, are targeted to your interests, such as targeted banner advertisements, administrative notices, product offerings, and communications relevant to your use of the web site. To receive such information, you accept for our terms and condition and privacy policy.</p>

            <p class="mb-4">Unless otherwise you give your consent, it doesn't sell, rent, share, trade or give away or share with any third party. The users who enter into site such as Builders, Agents/Brokers or any individual has provided their contact information for advertisement on our portal then users can contact them at their request through us.</p>

            <p class="mb-4">Any changes in the privacy policy will be changed without any prior notice to any type of users, of our web site. We suggest you to review our privacy policy from time to time/ periodically, so as to see if any changes are made.</p>

            <p class="mb-4">www.adityamatrimony.com cannot be held liable for any errors or inconsistencies. But we take every care to give you accuracy and clarity of the information.</p>

            <p class="mb-4">www.adityamatrimony.com disclaims any and all responsibility or liability for the accuracy, content, completeness, legality, reliability, or operability or availability of information or material displayed on this web site by the third parties...</p>

            <p class="mt-6 mb-3 font-bold" style="font-size: 21px;">Contact</p>
            <p class="mb-4">info@adityamatrimony.com for further clarifications.</p>
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
<?php /**PATH D:\dir\Aditya Matrimony\resources\views/default/view/pages/privacy_policy.blade.php ENDPATH**/ ?>