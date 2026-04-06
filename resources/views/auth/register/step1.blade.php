<div class="flex h-[82vh] items-center justify-center">
    <div class="card bg-base-300 w-sm md:w-md shadow-sm">
        <form action="/register" method="post" class="card-body">
            <h2 class="text-center font-bold text-2xl">Register</h2>
            <div class="flex justify-center -mt-7 mb-2">
                <x-registration-steps></x-registration-steps>
            </div>
            @csrf
            <input type="hidden" name="step" value="2">
            <div>
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" placeholder="Merajul" value="{{ $data['first_name'] ?? '' }}"
                       class="input w-full" id="first_name" required>
            </div>
            <div>
                <label for="last_name">Last Name</label>
                <input type="text" placeholder="Islam" name="last_name" class="input w-full"
                       value="{{ $data['last_name'] ?? '' }}" id="last_name" required />
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" placeholder="email@domain.com" name="email" class="input w-full"
                       value="{{ $data['email'] ?? '' }}" id="email" required />
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <label for="photo">Photo</label>
                    <div class="tooltip tooltip-right relative">
                        <div class="tooltip-content z-[400]">Upload your photo to imgbb and paste the direct image
                            URL
                            here.
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-5 cursor-help opacity-60">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <input type="url" placeholder="https://i.ibb.co...." name="photo" class="input w-full flex-1"
                           value="{{ $data['photo'] ?? '' }}" id="photo" required />
                    <a href="https://imgbb.com" target="_blank" class="btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-3">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                        Upload</a>
                </div>
            </div>
            <div class="mt-2 text-center">
                <a href="/login" class="hover:text-primary">Already have an account?</a>
            </div>
            <div class="card-actions justify-end">
                <button type="submit" class="btn">Next
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-4 mt-0.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>
