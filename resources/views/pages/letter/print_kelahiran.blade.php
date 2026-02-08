<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat Kelahiran - {{ $letter->resident->name }}</title>
    <style>
        * { box-sizing: border-box; }
        @page { size: A4 portrait; margin: 2cm; }
        body { font-family: 'Times New Roman', Times, serif; line-height: 1.6; margin: 0; padding: 0; color: black; }
        .container { width: 100%; }
        .content { margin-top: 10px; text-align: justify; }
        .content p { margin-bottom: 15px; text-indent: 40px; }
        .content .no-indent { text-indent: 0; }
        .table-data { width: 100%; margin: 10px 0; border-collapse: collapse; table-layout: fixed; }
        .table-data td { vertical-align: top; padding: 3px; word-wrap: break-word; }
        .label-column { width: 170px; } 
        .separator-column { width: 15px; }
        .signature-table { width: 100%; margin-top: 40px; border: none; border-collapse: collapse; }
        .signature-table td { text-align: center; vertical-align: top; padding: 0; }
        
        @media screen {
            body { background: #eee; padding: 40px 20px; }
            .container { background: white; width: 210mm; min-height: 297mm; margin: 0 auto; padding: 2.5cm; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        }
        @media print {
            body { background: white; margin: 0; }
            .no-print { display: none; }
            .container { width: 100%; margin: 0; padding: 0; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- KOP SURAT -->
        <table style="width: 100%; border-bottom: 4px double black; margin-bottom: 25px; padding-bottom: 10px;">
            <tr>
                <td style="width: 15%; vertical-align: middle; text-align: center;"></td>
                <td style="width: 85%; text-align: center; vertical-align: middle;">
                    <h3 style="margin: 0; font-size: 18px; text-transform: uppercase;">PEMERINTAH KABUPATEN LEBAK</h3>
                    <h3 style="margin: 0; font-size: 18px; text-transform: uppercase;">KECAMATAN SAJIRA</h3>
                    <h2 style="margin: 0; font-size: 24px; text-transform: uppercase; font-weight: bold;">DESA SAJIRA</h2>
                    <p style="margin: 0; font-size: 12px; font-style: italic;">Alamat: Jl. Raya Sajira No. 1, Desa Sajira, Kec. Sajira, Kab. Lebak - Banten 42371</p>
                </td>
            </tr>
        </table>

        <div style="text-align: center; margin-bottom: 25px;">
            <h3 style="text-decoration: underline; margin-bottom: 2px;">SURAT KETERANGAN KELAHIRAN</h3>
            <span style="font-size: 14px;">Nomor: {{ $letter->letter_number }}</span>
        </div>

        <div class="content">
            <p class="no-indent">Yang bertanda tangan di bawah ini, Kepala Desa Sajira, Kecamatan Sajira, Kabupaten Lebak, Provinsi Banten, dengan ini menerangkan bahwa telah lahir seorang anak:</p>
            
            <table class="table-data">
                <tr>
                    <td class="label-column">Nama Anak</td>
                    <td class="separator-column">:</td>
                    <td><strong>{{ strtoupper($letter->resident->name) }}</strong></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{ $letter->resident->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <td>Tempat, Tgl Lahir</td>
                    <td>:</td>
                    <td>{{ $letter->resident->birth_place }}, {{ \Carbon\Carbon::parse($letter->resident->birth_date)->isoFormat('D MMMM Y') }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $letter->resident->address }}</td>
                </tr>
            </table>

            <p>Anak tersebut adalah anak kandung dari pasangan suami istri yang merupakan warga Desa Sajira.</p>
            
            <p>Surat keterangan ini dibuat sebagai keterangan untuk keperluan: <strong>{{ $letter->remarks }}</strong>.</p>
            
            <p>Demikian surat keterangan ini kami buat dengan sebenarnya, untuk dapat dipergunakan sebagaimana mestinya.</p>
        </div>

        <table class="signature-table">
            <tr>
                <td width="50%">&nbsp;</td>
                <td width="50%">
                    <div style="margin-bottom: 5px;">Sajira, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</div>
                    <div style="margin-bottom: 70px;">Kepala Desa Sajira</div>
                    <div style="font-weight: bold; text-decoration: underline;">MUHAMMAD CHANDRA</div>
                </td>
            </tr>
        </table>

        @if(!$is_pdf)
        <div class="no-print" style="margin-top: 50px; text-align: center; border-top: 1px solid #eee; padding-top: 20px;">
            <button onclick="window.print()" style="padding: 10px 30px; font-size: 16px; cursor: pointer; background: #4e73df; color: white; border: none; border-radius: 5px;">Cetak Surat (Printer)</button>
            <div style="margin-top: 15px;">
                <a href="{{ route('letters.index') }}" style="color: #858796; text-decoration: none;">&larr; Kembali ke Daftar</a>
            </div>
        </div>
        @endif
    </div>
</body>
</html>
