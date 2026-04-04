<div class="flex h-[82vh] items-center justify-center">
    <div class="card bg-base-300 min-w-sm max-w-xl shadow-sm">
        <form action="/register" method="post" class="card-body">
            @csrf
            <h2 class="card-title">Step 1</h2>
            <input type="hidden" name="step" value="2">
            <div>
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" placeholder="Merajul" value="{{ $data['first_name'] ?? '' }}"
                       class="input" required>
            </div>
            <div>
                <label for="last_name">Last Name</label>
                <input type="text" placeholder="Islam" name="last_name" class="input"
                       value="{{ $data['last_name'] ?? '' }}" required />
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" placeholder="Islam" name="email" class="input"
                       value="{{ $data['email'] ?? '' }}" required />
            </div>
            <div class="card-actions justify-end">
                <button type="submit" class="btn">Next</button>
            </div>
        </form>
    </div>
</div>
