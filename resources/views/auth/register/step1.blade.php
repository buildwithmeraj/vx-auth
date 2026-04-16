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
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4">
                            <path fill-rule="evenodd"
                                  d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM8.94 6.94a.75.75 0 1 1-1.061-1.061 3 3 0 1 1 2.871 5.026v.345a.75.75 0 0 1-1.5 0v-.5c0-.72.57-1.172 1.081-1.287A1.5 1.5 0 1 0 8.94 6.94ZM10 15a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                                  clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <input type="url" placeholder="https://i.ibb.co...." name="photo" class="input w-full flex-1"
                           value="{{ $data['photo'] ?? '' }}" id="photo" required />
                    <a href="https://imgbb.com" target="_blank" class="btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4">
                            <path fill-rule="evenodd"
                                  d="M4.25 5.5a.75.75 0 0 0-.75.75v8.5c0 .414.336.75.75.75h8.5a.75.75 0 0 0 .75-.75v-4a.75.75 0 0 1 1.5 0v4A2.25 2.25 0 0 1 12.75 17h-8.5A2.25 2.25 0 0 1 2 14.75v-8.5A2.25 2.25 0 0 1 4.25 4h5a.75.75 0 0 1 0 1.5h-5Z"
                                  clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                  d="M6.194 12.753a.75.75 0 0 0 1.06.053L16.5 4.44v2.81a.75.75 0 0 0 1.5 0v-4.5a.75.75 0 0 0-.75-.75h-4.5a.75.75 0 0 0 0 1.5h2.553l-9.056 8.194a.75.75 0 0 0-.053 1.06Z"
                                  clip-rule="evenodd" />
                        </svg>
                        Upload</a>
                </div>
            </div>
            <div class="mt-2 text-center">
                <a href="/login" class="hover:text-primary">Already have an account?</a>
            </div>
            <div class="card-actions justify-end">
                <button type="submit" class="btn">Next
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                              d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 5.29a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.96H3.75A.75.75 0 0 1 3 10Z"
                              clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>
