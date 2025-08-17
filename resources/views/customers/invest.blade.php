@extends('layouts.customer')

@section('title', 'Invest')

@section('content')
@php
// Wallet addresses for each crypto
$wallets = [
    'BTC' => 'bc1qycy2ala0qcdestqpdutcd93aa075ucxk6hst5l',
    'ETH' => '0x9E14A00E3EE6Cb2BdD9DE418369b50d973fceF28',
    'SOL' => '5piLKpzX2sUjX6otjRaxFYCfCpSotCAX5EurDBVvJQQg',
    'USDT' => 'TVcUTgST8GVC2rngYuuqbMRq6wNkg1evfm',
    'USDC' => '0x9E14A00E3EE6Cb2BdD9DE418369b50d973fceF28',
    'XRP' => 'rnjKDM81rHizwrdVs6x6SVRnxkKDiaGotM',
];

// Map crypto to exact logo filename in public folder
$logos = [
    'BTC' => 'Bitcoin.svg.png',
    'ETH' => 'Ethereum.png',
    'SOL' => 'Solana.png',
    'USDT' => 'USDT.png',
    'USDC' => 'USDC.png',
    'XRP' => 'XRP.webp',
];
@endphp

<div class="max-w-7xl mx-auto mt-20 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 px-4">
    @foreach ($wallets as $crypto => $address)
    <div class="bg-[#1e1e1e] p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 cursor-pointer flex flex-col justify-between">
        <div>
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center gap-3">
                    <img src="{{ asset($logos[$crypto]) }}" alt="{{ $crypto }} Icon" class="h-8 w-8"/>
                    <h3 class="text-lg font-semibold text-[#E7AC08]">{{ $crypto }}</h3>
                </div>
            </div>
            <p class="text-sm text-gray-300 mb-3">
                @switch($crypto)
                    @case('BTC')
                        Bitcoin is the original decentralized cryptocurrency, enabling peer-to-peer digital payments worldwide.
                        @break
                    @case('ETH')
                        Ethereum is a leading blockchain platform for smart contracts and decentralized apps.
                        @break
                    @case('SOL')
                        Solana is a fast, scalable blockchain for decentralized finance and apps.
                        @break
                    @case('USDT')
                        Tether is a stablecoin pegged to the US dollar, ideal for secure digital transactions.
                        @break
                    @case('USDC')
                        USD Coin is a trusted US dollar-backed stablecoin for seamless crypto transfers.
                        @break
                    @case('XRP')
                        XRP powers fast, low-cost international money transfers on the Ripple network.
                        @break
                    @default
                        Crypto description not available.
                @endswitch
            </p>
        </div>
        <button
            onclick="showWallet('{{ $crypto }}')"
            class="mt-4 bg-[#E7AC08] text-black px-2 py-1 rounded hover:bg-yellow-600 transition text-xs font-semibold"
        >
            Show Wallet
        </button>
    </div>
    @endforeach
</div>

<!-- Modal Popup -->
<div id="walletModal" class="fixed inset-0 bg-black bg-opacity-70 hidden flex items-center justify-center z-50">
    <div class="bg-[#1e1e1e] p-6 rounded-lg max-w-sm w-full text-white mx-4">
        <h3 id="walletModalTitle" class="text-xl font-semibold mb-4"></h3>
        <div class="flex items-center mb-4 gap-2">
            <p id="walletModalAddress" class="break-all text-yellow-400 flex-grow"></p>
            <button id="copyWalletBtn" onclick="copyWalletAddress()" class="bg-yellow-600 hover:bg-yellow-700 px-3 py-1 rounded text-black font-semibold text-sm">
                Copy
            </button>
        </div>
        <button onclick="closeWalletModal()" class="bg-yellow-600 hover:bg-yellow-700 px-4 py-2 rounded text-black font-semibold">Close</button>
    </div>
</div>

<script>
    const walletAddresses = @json($wallets);

    function showWallet(crypto) {
        const address = walletAddresses[crypto];
        document.getElementById('walletModalTitle').textContent = crypto + ' Wallet Address';
        document.getElementById('walletModalAddress').textContent = address;
        document.getElementById('walletModal').classList.remove('hidden');

        // Reset copy button text on each modal open
        const copyBtn = document.getElementById('copyWalletBtn');
        copyBtn.textContent = 'Copy';
        copyBtn.disabled = false;
    }

    function closeWalletModal() {
        document.getElementById('walletModal').classList.add('hidden');
    }

    function copyWalletAddress() {
        const address = document.getElementById('walletModalAddress').textContent;
        navigator.clipboard.writeText(address).then(() => {
            const copyBtn = document.getElementById('copyWalletBtn');
            copyBtn.textContent = 'Copied!';
            copyBtn.disabled = true;
            setTimeout(() => {
                copyBtn.textContent = 'Copy';
                copyBtn.disabled = false;
            }, 2000);
        });
    }
</script>
@endsection
