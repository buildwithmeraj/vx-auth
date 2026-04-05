<div class="flex h-[82vh] items-center justify-center">
    <div class="card bg-base-300 w-sm shadow-sm">
        <form action="/register" method="post" class="card-body">
            @csrf
            <h2 class="card-title">Step 3</h2>
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
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
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
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z" />
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
            <label class="label"><input type="checkbox" name="agreement" class="checkbox mr-2" required />
                I agree</label>
            <div class="card-actions justify-between">
                <button type="submit" form="prev" class="btn">Prev</button>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
</div>
<form action="/register" method="post" id="prev">
    @csrf
    <input type="hidden" name="step" value="2">
</form>
