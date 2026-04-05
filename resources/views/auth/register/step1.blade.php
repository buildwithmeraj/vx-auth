<div class="flex h-[82vh] items-center justify-center">
    <div class="card bg-base-300 w-sm shadow-sm">
        <form action="/register" method="post" class="card-body">
            @csrf
            <input type="hidden" name="step" value="2">
            <div>
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" placeholder="Merajul" value="{{ $data['first_name'] ?? '' }}"
                       class="input w-full" required>
            </div>
            <div>
                <label for="last_name">Last Name</label>
                <input type="text" placeholder="Islam" name="last_name" class="input w-full"
                       value="{{ $data['last_name'] ?? '' }}" required />
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" placeholder="Islam" name="email" class="input w-full"
                       value="{{ $data['email'] ?? '' }}" required />
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <label for="photo">Photo

                    </label>
                    <div class="tooltip tooltip-right relative">
                        <div class="tooltip-content z-[400]">Upload your photo to imgbb and paste the direct image
                            URL
                            here.
                        </div>
                        <span class="cursor-help font-bold text-sm text-base-content/80 ml-2">
                            ?
                        </span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <input type="url" placeholder="https://i.ibb.co...." name="photo" class="input w-full flex-1"
                           value="{{ $data['photo'] ?? '' }}" required />
                    <a href="https://imgbb.com" target="_blank" class="btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-4">
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
                <button type="submit" class="btn">Next</button>
            </div>
        </form>
    </div>
</div>
