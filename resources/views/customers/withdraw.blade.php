@extends('layouts.customer')

@section('title', 'Withdraw Funds')

@section('content')
<div class="max-w-3xl mx-auto mt-16 p-6 bg-black bg-opacity-80 rounded-xl shadow-lg text-white">
    <h1 class="text-3xl font-semibold mb-4">Withdraw Instructions</h1>

    <ol class="list-decimal list-inside mb-6 space-y-2 text-lg">
        <li>Copy the wallet address below.</li>
        <li>Open your crypto wallet or exchange.</li>
        <li>Paste the address and enter the amount.</li>
        <li>Double-check and confirm the transfer.</li>
    </ol>

    <p class="mb-6 text-lg">
        This is your unique generated wallet address:
    </p>

    <div class="flex items-center gap-2 mb-4">
        <input
            type="text"
            readonly
            id="walletAddress"
            value="bc1qqrrmvrsvg89vrhc5l2dfz6ep4k598cxpprftgv"
            class="flex-grow rounded bg-[#E7AC08] px-3 py-2 font-mono text-black break-words"
        />
        <button
            id="copyBtn"
            class="bg-[#E7AC08] hover:bg-yellow-800 px-4 py-2 rounded font-semibold text-black"
        >
            Copy
        </button>
    </div>

    <a href="{{ route('dashboard') }}" class="inline-block bg-[#E7AC08] hover:bg-yellow-700 text-black font-bold py-2 px-5 rounded-full transition duration-300">
        Back to Dashboard
    </a>
</div>

<script>
    document.getElementById('copyBtn').addEventListener('click', function() {
        const walletInput = document.getElementById('walletAddress');

        // Select the input text
        walletInput.select();
        walletInput.setSelectionRange(0, 99999); // For mobile devices

        try {
            const successful = document.execCommand('copy');
            if (successful) {
                const btn = this;
                btn.innerText = 'Copied!';
                btn.disabled = true;
                setTimeout(() => {
                    btn.innerText = 'Copy';
                    btn.disabled = false;
                }, 2000);
            } else {
                alert('Failed to copy. Please copy manually.');
            }
        } catch (err) {
            alert('Failed to copy. Please copy manually.');
        }
    });
</script>
@endsection
