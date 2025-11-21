@extends('layouts.user')

@section('title', 'Keranjang Barang')

@section('header')
Keranjang Barang
@endsection

@section('content')
<div class="h-full">
    <div class="max-w-full">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="mb-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800">Keranjang Pengambilan</h2>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('user.pengambilan.index') }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-semibold tracking-widest text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:bg-gray-50 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                <div class="relative p-4 mb-4 text-blue-700 bg-blue-100 border-l-4 border-blue-500 rounded">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
                @endif

                @if(session('error'))
                <div class="relative p-4 mb-4 text-red-700 bg-red-100 border-l-4 border-red-500 rounded">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
                @endif

                <div id="cart-container">
                    <!-- Cart content loaded server-side -->
                    @include('user.cart.partials.cart-content', ['cartByBidang' => $cartByBidang])
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Item Modal -->
<div id="editItemModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50">
    <div class="relative w-full max-w-lg mx-auto bg-white rounded-lg shadow-lg">
        <!-- Modal Header -->
        <div class="px-6 py-4 rounded-t-lg" style="background-color: #0074BC;">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-white">
                    Edit Item Keranjang
                </h3>
                <button onclick="closeEditModal()" class="text-white hover:text-blue-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <form id="editItemForm">
                @csrf
                <input type="hidden" id="edit_cart_id" name="cart_id">

                <!-- Nama Barang Section -->
                <div class="mb-4">
                    <label class="flex items-center mb-2 text-sm font-medium text-gray-700">
                        <i class="mr-2 text-gray-500 fas fa-box"></i>
                        Nama Barang
                    </label>
                    <div class="p-3 border border-gray-300 rounded-md bg-gray-50">
                        <p id="edit_barang_nama" class="font-medium text-gray-900">Loading...</p>
                        <p class="mt-1 text-sm text-gray-500">
                            Stok tersedia: <span id="edit_max_stock" class="font-semibold">0</span> <span
                                id="edit_satuan">pcs</span>
                        </p>
                    </div>
                </div>

                <!-- Quantity Section -->
                <div class="mb-4">
                    <label class="flex items-center mb-2 text-sm font-medium text-gray-700">
                        <i class="mr-2 text-gray-500 fas fa-calculator"></i>
                        Jumlah
                    </label>
                    <div class="flex items-center justify-center space-x-3">
                        <button type="button" onclick="editDecreaseQuantity()"
                            class="flex items-center justify-center w-8 h-8 text-white transition-colors duration-200 rounded-md"
                            style="background-color: #0074BC;" onmouseover="this.style.backgroundColor='#005a94'"
                            onmouseout="this.style.backgroundColor='#0074BC'">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="number" id="edit_quantity" name="quantity" min="1" value="1"
                            class="w-16 h-8 text-center transition-colors duration-200 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <button type="button" onclick="editIncreaseQuantity()"
                            class="flex items-center justify-center w-8 h-8 text-white transition-colors duration-200 rounded-md"
                            style="background-color: #0074BC;" onmouseover="this.style.backgroundColor='#005a94'"
                            onmouseout="this.style.backgroundColor='#0074BC'">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>

                <!-- Bidang Section -->
                <div class="mb-4">
                    <label for="edit_bidang" class="flex items-center mb-2 text-sm font-medium text-gray-700">
                        <i class="mr-2 text-gray-500 fas fa-building"></i>
                        Bidang <span class="text-red-500">*</span>
                    </label>
                    @if(Auth::user()->bidang && \App\Constants\BidangConstants::isValidBidang(Auth::user()->bidang))
                    <!-- Field bidang readonly jika user sudah terdaftar dengan bidang tertentu -->
                    <div class="bg-gray-50 border border-gray-300 rounded-md p-3">
                        <p class="font-medium text-gray-900">{{
                            \App\Constants\BidangConstants::getBidangName(Auth::user()->bidang) }}</p>
                    </div>
                    <input type="hidden" id="edit_bidang" name="bidang" value="{{ Auth::user()->bidang }}">
                    @else
                    <!-- Dropdown bidang jika user belum memiliki bidang yang terdaftar -->
                    <select id="edit_bidang" name="bidang" required
                        class="w-full px-3 py-2 transition-colors duration-200 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Bidang</option>
                        @foreach(\App\Constants\BidangConstants::getBidangList() as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    @endif
                </div>

                <!-- Nama Pengambil Section -->
                <div class="mb-4">
                    <label for="edit_pengambil" class="flex items-center mb-2 text-sm font-medium text-gray-700">
                        <i class="mr-2 text-gray-500 fas fa-user"></i>
                        Nama Pengambil <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="edit_pengambil" name="pengambil" required
                        class="w-full px-3 py-2 transition-colors duration-200 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan nama pengambil...">
                </div>

                <!-- Keterangan Section -->
                <div class="mb-4">
                    <label for="edit_keterangan" class="flex items-center mb-2 text-sm font-medium text-gray-700">
                        <i class="mr-2 text-gray-500 fas fa-sticky-note"></i>
                        Keterangan <span class="text-xs text-gray-400">(opsional)</span>
                    </label>
                    <textarea id="edit_keterangan" name="keterangan" rows="3"
                        class="w-full px-3 py-2 transition-colors duration-200 border border-gray-300 rounded-md resize-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Keterangan tambahan..."></textarea>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="flex px-6 py-4 space-x-3 rounded-b-lg bg-gray-50">
            <button onclick="closeEditModal()"
                class="flex-1 px-4 py-2 font-semibold text-white transition-colors duration-200 bg-gray-500 rounded-md hover:bg-gray-600">
                Batal
            </button>
            <button id="updateItemBtn" onclick="updateCartItem()"
                class="flex-1 px-4 py-2 font-semibold text-white transition-colors duration-200 rounded-md"
                style="background-color: #0074BC;" onmouseover="this.style.backgroundColor='#005a94'"
                onmouseout="this.style.backgroundColor='#0074BC'">
                Simpan
            </button>
        </div>
    </div>
</div>

<script>
    // Bidang constants for JavaScript
const bidangNames = @json(\App\Constants\BidangConstants::getBidangList());

// Load cart content when page loads
document.addEventListener('DOMContentLoaded', function() {
    loadCartContent();
});

// Show message notification
function showMessage(message, type = 'info') {
    // Remove existing messages
    const existingMessages = document.querySelectorAll('.notification-message');
    existingMessages.forEach(msg => msg.remove());

    const alertClass = type === 'success' ? 'bg-blue-100 border-blue-500 text-blue-700' :
                     type === 'error' ? 'bg-red-100 border-red-500 text-red-700' :
                     'bg-blue-100 border-blue-500 text-blue-700';

    const messageDiv = document.createElement('div');
    messageDiv.className = `notification-message mb-4 ${alertClass} border-l-4 p-4 rounded relative`;
    messageDiv.innerHTML = `
        <div class="flex items-center justify-between">
            <span class="block sm:inline">${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-current hover:opacity-75">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;

    // Insert at the top of cart container
    const cartContainer = document.getElementById('cart-container');
    cartContainer.insertBefore(messageDiv, cartContainer.firstChild);

    // Auto remove after 5 seconds
    setTimeout(() => {
        if (messageDiv.parentNode) {
            messageDiv.remove();
        }
    }, 5000);
}

// Load cart content
function loadCartContent() {
    fetch('{{ route("user.cart.index") }}', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'text/html'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.text();
    })
    .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const cartContent = doc.querySelector('#cart-content');
        if (cartContent) {
            document.getElementById('cart-container').innerHTML = cartContent.outerHTML;
        } else {
            // Reload the page if partial content fails
            window.location.reload();
        }
    })
    .catch(error => {
        showMessage('Gagal memuat keranjang. Silakan refresh halaman.', 'error');
    });
}

// Update cart item quantity
function updateQuantity(cartId, change) {
    const currentQuantitySpan = document.querySelector(`#quantity-${cartId}`);
    const currentQuantity = parseInt(currentQuantitySpan.textContent);
    const newQuantity = currentQuantity + change;

    if (newQuantity < 1) return;

    const formData = new FormData();
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    formData.append('quantity', newQuantity);

    fetch(`{{ url('user/cart/update') }}/${cartId}`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showMessage(data.message, 'success');
            loadCartContent();
        } else {
            showMessage(data.message || 'Terjadi kesalahan saat mengupdate quantity.', 'error');
        }
    })
    .catch(error => {
        showMessage('Terjadi kesalahan saat mengupdate quantity.', 'error');
    });
}

// Remove item from cart
function removeItem(cartId) {
    Swal.fire({
        title: 'Hapus Item?',
        text: 'Yakin ingin menghapus item ini dari keranjang?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#6b7280',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '<i class="fas fa-trash"></i> Hapus!',
        cancelButtonText: '<i class="fas fa-times"></i> Batal'
    }).then((result) => {
        if (!result.isConfirmed) {
            return;
        }

        const formData = new FormData();
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        formData.append('_method', 'DELETE');

        fetch(`{{ url('user/cart/remove') }}/${cartId}`, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadCartContent();
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    toast: true,
                    position: 'top-end'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message || 'Terjadi kesalahan saat menghapus item.',
                    confirmButtonColor: '#d33'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                text: 'Terjadi kesalahan saat menghapus item.',
                confirmButtonColor: '#d33'
            });
        });
    });
}

// Clear cart
function clearCart() {
    Swal.fire({
        title: 'Kosongkan Keranjang?',
        text: 'Yakin ingin mengosongkan semua item di keranjang?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: '<i class="mr-2 fas fa-trash"></i>Ya, Kosongkan!',
        cancelButtonText: '<i class="mr-2 fas fa-times"></i>Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading state
            Swal.fire({
                title: 'Mengosongkan Keranjang...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            formData.append('_method', 'DELETE');

            fetch('{{ route("user.cart.clear") }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadCartContent();
                    Swal.fire({
                        title: 'Berhasil!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonColor: '#16a34a',
                        confirmButtonText: '<i class="mr-2 fas fa-check"></i>OK'
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: data.message || 'Terjadi kesalahan saat mengosongkan keranjang.',
                        icon: 'error',
                        confirmButtonColor: '#dc2626',
                        confirmButtonText: '<i class="mr-2 fas fa-times"></i>OK'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat mengosongkan keranjang.',
                    icon: 'error',
                    confirmButtonColor: '#dc2626',
                    confirmButtonText: '<i class="mr-2 fas fa-times"></i>OK'
                });
            });
        }
    });
}

// Edit item modal functions
function showEditModal(cartId, namaBarang, quantity, bidang, keterangan, pengambil, maxStock, satuan) {
    document.getElementById('edit_cart_id').value = cartId;
    document.getElementById('edit_barang_nama').textContent = namaBarang;
    document.getElementById('edit_quantity').value = quantity;
    document.getElementById('edit_quantity').max = maxStock;

    // Set bidang value hanya jika bukan hidden input (berarti user bisa memilih)
    const bidangElement = document.getElementById('edit_bidang');
    if (bidangElement && bidangElement.tagName.toLowerCase() === 'select') {
        bidangElement.value = bidang;
    }

    document.getElementById('edit_keterangan').value = keterangan || '';
    document.getElementById('edit_pengambil').value = pengambil || '';
    document.getElementById('edit_max_stock').textContent = maxStock;
    document.getElementById('edit_satuan').textContent = satuan;

    const modal = document.getElementById('editItemModal');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden'; // Prevent background scroll
    setTimeout(() => {
        modal.classList.add('show');
    }, 10);
}

function closeEditModal() {
    const modal = document.getElementById('editItemModal');
    modal.classList.remove('show');
    document.body.style.overflow = 'auto'; // Restore background scroll
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

function editIncreaseQuantity() {
    const quantityInput = document.getElementById('edit_quantity');
    const maxStock = parseInt(document.getElementById('edit_max_stock').textContent);
    const currentValue = parseInt(quantityInput.value);
    if (currentValue < maxStock) {
        quantityInput.value = currentValue + 1;
    }
}

function editDecreaseQuantity() {
    const quantityInput = document.getElementById('edit_quantity');
    const currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
}

function updateCartItem() {
    const form = document.getElementById('editItemForm');
    const formData = new FormData(form);
    const updateBtn = document.getElementById('updateItemBtn');
    const cartId = document.getElementById('edit_cart_id').value;

    // Validate required fields
    const bidang = formData.get('bidang');
    const pengambil = formData.get('pengambil');

    if (!bidang || bidang.trim() === '') {
        Swal.fire({
            icon: 'warning',
            title: 'Perhatian!',
            text: 'Bidang harus terisi. Pastikan akun Anda sudah terdaftar dengan bidang yang sesuai.',
            confirmButtonColor: '#f59e0b'
        });
        return;
    }

    if (!pengambil || pengambil.trim() === '') {
        Swal.fire({
            icon: 'warning',
            title: 'Perhatian!',
            text: 'Nama pengambil harus diisi.',
            confirmButtonColor: '#f59e0b'
        });
        return;
    }

    updateBtn.disabled = true;
    updateBtn.textContent = 'Mengupdate...';

    fetch(`{{ url('user/cart/update') }}/${cartId}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeEditModal();
            loadCartContent();

            // Show SweetAlert success message
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: data.message,
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                toast: true,
                position: 'top-end'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: data.message || 'Terjadi kesalahan saat mengupdate item.',
                confirmButtonColor: '#d33'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan!',
            text: 'Terjadi kesalahan saat mengupdate item.',
            confirmButtonColor: '#d33'
        });
    })
    .finally(() => {
        updateBtn.disabled = false;
        updateBtn.textContent = 'Simpan';
    });
}

// Submit pengambilan untuk bidang tertentu
function submitPengambilanBidang(bidang) {
    // Tampilkan SweetAlert konfirmasi
    Swal.fire({
        title: 'Konfirmasi Pengambilan',
        text: `Yakin ingin mencatat pengambilan untuk semua item di bidang ${bidangNames[bidang] || bidang}?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3b82f6',
        cancelButtonColor: '#9ca3af',
        confirmButtonText: '<i class="mr-2 fas fa-check"></i>Simpan',
        cancelButtonText: '<i class="mr-2 fas fa-times"></i>Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            processCheckoutDirect(bidang);
        }
    });
}

// Process checkout langsung tanpa modal input nama pengambil
function processCheckoutDirect(bidang) {
    const formData = new FormData();
    formData.append('bidang', bidang);

    // Tampilkan loading
    Swal.fire({
        title: 'Memproses Pengajuan...',
        text: 'Mohon tunggu sebentar',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch('{{ route("user.cart.checkout") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                title: 'Berhasil!',
                text: data.message,
                icon: 'success',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            }).then(() => {
                loadCartContent(); // Refresh cart content
            });
        } else {
            Swal.fire({
                title: 'Gagal!',
                text: data.message || 'Terjadi kesalahan saat pencatatan pengambilan.',
                icon: 'error',
                confirmButtonColor: '#dc2626',
                confirmButtonText: '<i class="mr-2 fas fa-times"></i>OK'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            title: 'Error!',
            text: 'Terjadi kesalahan saat pencatatan pengambilan.',
            icon: 'error',
            confirmButtonColor: '#dc2626',
            confirmButtonText: '<i class="mr-2 fas fa-times"></i>OK'
        });
    });
}

    // Close modals when clicking outside
window.onclick = function(event) {
    const editModal = document.getElementById('editItemModal');

    if (event.target == editModal) {
        closeEditModal();
    }
}

// Close modal with ESC key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const modal = document.getElementById('editItemModal');
        if (!modal.classList.contains('hidden')) {
            closeEditModal();
        }
    }
});
</script>

<style>
    /* Modal styles */
    #editItemModal.show {
        display: flex !important;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    #editItemModal {
        display: none;
    }

    #editItemModal>div {
        margin: auto;
        max-height: calc(100vh - 2rem);
        overflow-y: auto;
    }

    /* Custom input number controls */
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }

    /* Animation for modal */
    #editItemModal {
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    #editItemModal.show {
        opacity: 1;
    }

    #editItemModal>div {
        transform: scale(0.95);
        transition: transform 0.3s ease-in-out;
    }

    #editItemModal.show>div {
        transform: scale(1);
    }
</style>

@endsection
