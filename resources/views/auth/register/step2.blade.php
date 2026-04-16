<div class="flex h-[82vh] items-center justify-center">
    <div class="card bg-base-300 w-sm md:w-md shadow-sm">
        <form action="/register" method="post" class="card-body">
            @csrf
            <h2 class="text-center font-bold text-2xl">Register</h2>
            <div class="flex justify-center -mt-7 mb-2">
                <x-registration-steps></x-registration-steps>
            </div>
            <input type="hidden" name="step" value="3">
            <div>
                <label for="gender">Gender</label>
                <select class="select w-full" name="gender" id="gender" required>
                    <option value="male" {{ ($data['gender'] ?? '') === "male" ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ ($data['gender'] ?? '') === "female" ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ ($data['gender'] ?? '') === "other" ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div>
                <label for="phone">Phone</label>
                <input type="tel" placeholder="+8801XXXXXXXXX" name="phone" class="input w-full"
                       value="{{ $data['phone'] ?? '' }}" id="phone" required />
            </div>
            <div>
                <label for="address">Address</label>
                <input type="text" placeholder="Dhaka-1201, Bangladesh" name="address" class="input w-full"
                       value="{{ $data['address'] ?? '' }}" id="address" required />
            </div>
            <div class="card-actions justify-between mt-2">
                <button type="submit" form="prev" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                              d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z"
                              clip-rule="evenodd" />
                    </svg>

                    Previous
                </button>
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


<form action="/register" method="post" id="prev">
    @csrf
    <input type="hidden" name="step" value="1">
</form>

