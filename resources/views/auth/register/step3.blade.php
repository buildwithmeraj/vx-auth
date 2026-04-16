<div class="flex h-[82vh] items-center justify-center">
    <div class="card bg-base-300 w-sm md:w-md shadow-sm">
        <form action="/register" method="post" class="card-body">
            @csrf
            <h2 class="text-center font-bold text-2xl">Register</h2>
            <div class="flex justify-center -mt-7 mb-2">
                <x-registration-steps></x-registration-steps>
            </div>
            @error('registration')
            <x-alert-error>{{ $message }}</x-alert-error>
            @enderror
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <x-alert-error>{{ $error }}</x-alert-error>
                @endforeach
            @endif
            <input type="hidden" name="step" value="3">
            <div
                class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-box max-h-56 w-full overflow-y-auto">
                <input type="checkbox" />
                <div class="collapse-title font-semibold text-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                              d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z"
                              clip-rule="evenodd" />
                    </svg>
                    Data Collection Notice
                </div>
                <div class="collapse-content text-sm text-base-content/80 space-y-2 leading-relaxed">
                    <p><strong>Last updated: April 2026</strong></p>
                    <p>
                        By submitting this form, you acknowledge that <strong>Vixlo Technologies</strong>
                        will
                        collect and store
                        the following personal information:
                    </p>
                    <ul class="list-disc list-inside space-y-1 ml-2">
                        <li><strong>Identity data:</strong> First name, last name, gender</li>
                        <li><strong>Contact data:</strong> Email address, phone number, postal address</li>
                        <li><strong>Media data:</strong> Profile photograph (if uploaded)</li>
                        <li><strong>Account data:</strong> System-generated User ID, hashed password,
                            account
                            creation timestamp
                        </li>
                    </ul>
                    <p>
                        This data is collected solely for the purpose of account creation and identity
                        verification
                        within the Vixlo Technologies platform. Your data will not be sold or shared with
                        third
                        parties
                        without your explicit consent, except where required by applicable law.
                    </p>
                    <p>
                        Data is stored on secured servers and protected using industry-standard encryption
                        practices.
                        You may request deletion of your data at any time by contacting
                        <a href="mailto:privacy@vixlo.com" class="link link-primary">privacy@vixlo.com</a>.
                    </p>
                </div>
            </div>

            <div
                class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-box max-h-56 w-full overflow-y-auto">
                <input type="checkbox" />
                <div class="collapse-title font-semibold text-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                              d="M10.339 2.237a.531.531 0 0 0-.678 0 11.947 11.947 0 0 1-7.078 2.75.5.5 0 0 0-.479.425A12.11 12.11 0 0 0 2 7c0 5.163 3.26 9.564 7.834 11.257a.48.48 0 0 0 .332 0C14.74 16.564 18 12.163 18 7c0-.538-.035-1.069-.104-1.589a.5.5 0 0 0-.48-.425 11.947 11.947 0 0 1-7.077-2.75ZM10 6a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 6Zm0 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                              clip-rule="evenodd" />
                    </svg>
                    Privacy Policy
                </div>
                <div class="collapse-content text-sm text-base-content/80 space-y-3 leading-relaxed">
                    <p><strong>Effective Date: April 2026</strong></p>

                    <p>
                        <strong>1. Who We Are</strong><br>
                        Vixlo Technologies ("we", "us", "our") is a technology company headquartered at
                        36 Avenue Jean Jaurès, 93500 Pantin, Paris, France. We operate this platform to
                        facilitate user registration, identity management, and access control services.
                    </p>

                    <p>
                        <strong>2. Information We Collect</strong><br>
                        We collect information you directly provide during registration, including your
                        name,
                        email address, phone number, gender, home address, and an optional profile
                        photograph.
                        We also automatically collect account metadata such as your User ID, login
                        timestamps,
                        and IP address for security and audit purposes.
                    </p>

                    <p>
                        <strong>3. How We Use Your Information</strong><br>
                        Your information is used to create and manage your account, verify your identity,
                        send account-related communications (including your User ID and login credentials),
                        and maintain platform security. We do not use your data for advertising purposes.
                    </p>

                    <p>
                        <strong>4. Data Retention</strong><br>
                        We retain your personal data for as long as your account remains active. If you
                        request account deletion, your data will be permanently removed within 30 days,
                        except where retention is required by law.
                    </p>

                    <p>
                        <strong>5. Data Sharing</strong><br>
                        We do not sell, rent, or trade your personal information. Data may be disclosed
                        to law enforcement or regulatory bodies only when legally obligated to do so.
                    </p>

                    <p>
                        <strong>6. Your Rights</strong><br>
                        Under applicable data protection laws (including GDPR where applicable), you have
                        the right to access, correct, export, or delete your personal data. To exercise
                        these rights, contact us at
                        <a href="mailto:privacy@vixlo.com" class="link link-primary">privacy@vixlo.com</a>.
                    </p>

                    <p>
                        <strong>7. Security</strong><br>
                        We implement appropriate technical and organizational measures to protect your data
                        against unauthorized access, alteration, disclosure, or destruction. Passwords are
                        stored using bcrypt hashing and are never stored in plain text.
                    </p>

                    <p>
                        <strong>8. Changes to This Policy</strong><br>
                        We may update this Privacy Policy periodically. Significant changes will be
                        communicated via email to your registered address.
                    </p>
                </div>
            </div>
            <label class="label text-base-content mt-2"><input type="checkbox" id="agreement" name="agreement"
                                                               class="checkbox mr-2"
                                                               required />
                I agree to the terms and policies</label>
            <div class="card-actions justify-between mt-2">
                <button type="submit" form="prev" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                              d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z"
                              clip-rule="evenodd" />
                    </svg>
                    Previous
                </button>
                <button type="submit" name="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                              d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                              clip-rule="evenodd" />
                    </svg>
                    Submit
                </button>
            </div>

        </form>
    </div>
</div>
<form action="/register" method="post" id="prev">
    @csrf
    <input type="hidden" name="step" value="2">
</form>
