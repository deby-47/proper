<table>
    <tr>
        <td style="width: 30px;border:2px solid black;border-left:2px solid black">No</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 100px;border-top:2px solid black;border-right:2px solid black;text-align: center">Jenis</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 100px;border-top:2px solid black;border-right:2px solid black;text-align: center">Tanggal</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 50px;border-top:2px solid black;border-right:2px solid black;text-align: center">Selisih Hari</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 100px;border-top:2px solid black;border-right:2px solid black;text-align: center">Total GU</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 100px;border-top:2px solid black;border-right:2px solid black;text-align: center">Outstanding UP/TUP</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 50px;border-top:2px solid black;border-right:2px solid black;text-align: center">Persen (%) GUP</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 100px;border-top:2px solid black;border-right:2px solid black;text-align: center">Status</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 100px;border-top:2px solid black;border-right:2px solid black;text-align: center">Kepatuhan (50%)</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 100px;border-top:2px solid black;border-right:2px solid black;text-align: center">Persentase GUP (25%)</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 100px;border-top:2px solid black;border-right:2px solid black;text-align: center">&nbsp;</td>
        <td style="word-wrap:break-word;vertical-align: center;width: 100px;border-top:2px solid black;border-right:2px solid black;text-align: center">Setoran TUP (25%)</td>
    </tr>
    @php
        $kepatuhan = 0;
        $kolom_kosong  = 0;
        $setoran  = 0;
    @endphp
@foreach ($up_tup as $k => $v)
    <tr>
        <td style="border:2px solid black;border-left:2px solid black;text-align: center">{{ $k+1 }}</td>
        <td style="border:2px solid black;border-left:2px solid black;">
            @if($v->jenis_up == 1)
                GUP
            @elseif($v->jenis_up == 2)
                Jumlah
            @elseif($v->jenis_up == 3)
                Nilai Komponen
            @elseif($v->jenis_up == 4)
                PTUP
            @elseif($v->jenis_up == 5)
                Setoran TUP
            @elseif($v->jenis_up == 6)
                TUP
            @elseif($v->jenis_up == 7)
                UP
            @endif
        </td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: center">{{ date('d/m/Y',strtotime($v->tanggal_up)) }}</td>

        <td style="border:2px solid black;border-left:2px solid black;text-align: center">{{ $v->selisih_hari_up }}</td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: right">{{ $v->total_gu_up }}</td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: right">{{ $v->outstanding_up }}</td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: right">{{ $v->persen_up }}</td>
        <td style="border:2px solid black;border-left:2px solid black">
            @if ($v->status_up == 1)
                TEPAT WAKTU
            @elseif ($v->status_up == 2)
                TERLAMBAT
            @endif
        </td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: right">{{ $v->kepatuhan_up }}</td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: right">{{ $v->presentase_gup_up }}</td>
    
        <td style="border:2px solid black;border-left:2px solid black;text-align: right">{{ $v->presentase }}</td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: right">{{ $v->setoran_tup_up }}</td>
    </tr>
    @php
        $kepatuhan += $v->kepatuhan_up;
        $kolom_kosong  += $v->presentase;
        $setoran  += $v->setoran_tup_up;
    @endphp
@endforeach
    <tr>
        <td style="border:2px solid black;border-left:2px solid black" colspan="8">Jumlah</td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: right">{{ $kepatuhan }}</td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: right"></td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: right">{{ $kolom_kosong }}</td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: right">{{ $setoran }}</td>
    </tr>

    {{-- <tr>
        <td style="border:2px solid black;border-left:2px solid black" colspan="8">Nilai Komponen</td>
        <td style="border:2px solid black;border-left:2px solid black"></td>
        <td style="border:2px solid black;border-left:2px solid black"></td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: left">{{ number_format($komponen_tepat_waktu,2,",",".")."/".count($capaian)."=".number_format(($komponen_tepat_waktu/count($capaian)),2,",",".") }}</td>
        <td style="border:2px solid black;border-left:2px solid black;text-align: left">{{ number_format($komponen_capaian_ro,2,",",".")."/".count($capaian)."=".number_format(($komponen_capaian_ro/count($capaian)),2,",",".") }}</td>
    </tr>
    <tr>
        <td style="border:2px solid black;border-left:2px solid black" colspan="8">NILAI AKHIR</td>
        <td style="border:2px solid black;border-left:2px solid black"></td>
        <td style="border:2px solid black;border-left:2px solid black"></td>
        @php
            $a = ($komponen_tepat_waktu/count($capaian)) * 0.3;
            $b = ($komponen_capaian_ro/count($capaian)) * 0.7;
            $hasil = $a + $b;
        @endphp
        <td style="border:2px solid black;border-left:2px solid black;text-align: left" colspan="2">{{ "(".($komponen_tepat_waktu/count($capaian))." x 30 %) + (".($komponen_capaian_ro/count($capaian))." x 70 %) = ".$hasil }}</td>
    </tr> --}}





</table>



