@foreach ($barangs as $barang)
<tr class="main-row" data-code="{{ $barang->code }}">
    <td class="code">{{ $barang->code }}</td>
    <td class="machine">{{ $barang->machine }}</td>
    <td class="name_of_good">{{ $barang->name_of_good }}</td>
    <td class="specification">{{ $barang->detail->specification ?? 'N/A' }}</td>
    <td class="box">{{ $barang->detail->box ?? 'N/A' }}</td>
    <td class="closing">{{ $barang->detail->closing ?? 'N/A' }}</td>
    <td class="action-buttons">
        <button class="editBtn" title="Edit"><i class="fas fa-edit"></i></button>
        <button class="deleteBtn" title="Hapus"><i class="fas fa-trash-alt"></i></button>
    </td>
</tr>
<tr class="detail-row">
    <td colspan="7">
        <p><strong>Penggunaan 2024:</strong> <span class="using_2024">{{ $barang->detail->using_2024 ?? 'N/A' }}</span></p>
        <p><strong>Pembukaan:</strong> <span class="opening">{{ $barang->detail->opening ?? 'N/A' }}</span></p>
        <p><strong>Diterima:</strong> <span class="received">{{ $barang->detail->received ?? 'N/A' }}</span></p>
        <p><strong>Digunakan:</strong> <span class="used">{{ $barang->detail->used ?? 'N/A'}}</span></p>
    </td>
</tr>
@endforeach