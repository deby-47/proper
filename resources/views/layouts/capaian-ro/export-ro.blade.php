<table>
    <tr>
        <td style="width: 30px;border:2px solid black;border-left:2px solid black">No</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 100px;border-top:2px solid black;border-right:2px solid black">Sub Kegiatan</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 50px;border-top:2px solid black;border-right:2px solid black;text-align: center">RO</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 50px;border-top:2px solid black;border-right:2px solid black;text-align: center">Target RO</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 100px;border-top:2px solid black;border-right:2px solid black;text-align: center">Satuan</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 50px;border-top:2px solid black;border-right:2px solid black;text-align: center">RVRO</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 50px;border-top:2px solid black;border-right:2px solid black;text-align: center">PCRO</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 100px;border-top:2px solid black;border-right:2px solid black;text-align: center">Status Konfirmasi</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 100px;border-top:2px solid black;border-right:2px solid black;text-align: center">Target PCRO</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 100px;border-top:2px solid black;border-right:2px solid black;text-align: center">Batas Waktu Pelaporan</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 100px;border-top:2px solid black;border-right:2px solid black;text-align: center">Tanggal Kirim</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 100px;border-top:2px solid black;border-right:2px solid black;text-align: center">&nbsp;</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 100px;border-top:2px solid black;border-right:2px solid black;text-align: center">Status</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 100px;border-top:2px solid black;border-right:2px solid black;text-align: center">Komponen Tepat Waktu (30%)</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 100px;border-top:2px solid black;border-right:2px solid black;text-align: center">Komponen Tepat Waktu (30%)</td>
    </tr>
    @php
    $komponen_tepat_waktu = 0;
    $komponen_capaian_ro = 0;
    @endphp
    @foreach ($capaian as $k => $v)
    <tr>
        <td style="border:2px solid black;border-left:2px solid black;text-align: center">{{ $k+1 }}</td>
        <td style="border:2px solid black;border-left:2px solid black">{{ $v->sub_kegiatan }}</td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: left">{{ $v->ro }}</td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: left">{{ $v->target_ro }}</td>
        <td style="border:2px solid black;border-left:2px solid black">{{ $v->satuan }}</td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: left">{{ $v->rvro }}</td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: left">{{ $v->pcro }}</td>
        <td style="border:2px solid black;border-left:2px solid black">
            @if ($v->status_konfirmasi == 1)
            Terkonfirmasi
            @elseif ($v->status_konfirmasi == 2)
            Tidak Terkonfirmasi
            @endif
        </td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: left">{{ $v->target_pcro }}</td>
        <td style="border:2px solid black;border-left:2px solid black">{{ date('d/m/Y',strtotime($v->batas_waktu_pelaporan)) }}</td>
        <td style="border:2px solid black;border-left:2px solid black">{{ date('d/m/Y',strtotime($v->tanggal_kirim)) }}</td>
        <td style="border:2px solid black;border-left:2px solid black">{{ date('d/m/Y',strtotime($v->tanggal_kosong)) }}</td>
        <td style="border:2px solid black;border-left:2px solid black">
            @if ($v->status == 1)
            TEPAT WAKTU
            @elseif ($v->status == 2)
            TERLAMBAT
            @endif
        </td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: left">{{ $v->komponen_tepat_waktu }}</td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: left">{{ $v->komponen_capaian_ro }}</td>
    </tr>
    @php
    $komponen_tepat_waktu += $v->komponen_tepat_waktu;
    $komponen_capaian_ro += $v->komponen_capaian_ro;
    @endphp
    @endforeach
    <tr>
        <td style="border:2px solid black;border-left:2px solid black" colspan="11">TOTAL</td>
        <td style="border:2px solid black;border-left:2px solid black"></td>
        <td style="border:2px solid black;border-left:2px solid black"></td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: left">{{ $komponen_tepat_waktu }}</td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: left">{{ $komponen_capaian_ro }}</td>
    </tr>

    <tr>
        <td style="border:2px solid black;border-left:2px solid black" colspan="11">NILAI KOMPONEN</td>
        <td style="border:2px solid black;border-left:2px solid black"></td>
        <td style="border:2px solid black;border-left:2px solid black"></td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: left">{{ number_format($komponen_tepat_waktu,2,",",".")."/".count($capaian)."=".number_format(($komponen_tepat_waktu/count($capaian)),2,",",".") }}</td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: left">{{ number_format($komponen_capaian_ro,2,",",".")."/".count($capaian)."=".number_format(($komponen_capaian_ro/count($capaian)),2,",",".") }}</td>
    </tr>
    <tr>
        <td style="border:2px solid black;border-left:2px solid black" colspan="11">NILAI AKHIR</td>
        <td style="border:2px solid black;border-left:2px solid black"></td>
        <td style="border:2px solid black;border-left:2px solid black"></td>
        @php
        $a = ($komponen_tepat_waktu/count($capaian)) * 0.3;
        $b = ($komponen_capaian_ro/count($capaian)) * 0.7;
        $hasil = $a + $b;
        @endphp
        <td style="border:2px solid black;border-left:2px solid black;text-align: left" colspan="2">{{ "(".($komponen_tepat_waktu/count($capaian))." x 30 %) + (".($komponen_capaian_ro/count($capaian))." x 70 %) = ".$hasil }}</td>
    </tr>






</table>