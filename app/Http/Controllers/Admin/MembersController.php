<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\DiscordMember;

class MembersController extends Controller
{

    public function apiInsertMembers(Request $request)
    {
        // Gelen üyeler
        $members = $request->input('members');

        // Tüm üyeleri işleyelim
        foreach ($members as $member) {
            $discordId = $member['id'];
            $username = $member['username'];
            $discriminator = $member['discriminator'];
            $roles = $member['roles']; // Rolleri al

            // Kullanıcının veritabanında olup olmadığını kontrol et
            $existingMember = DiscordMember::where('discord_id', $discordId)->first();

            if (!$existingMember) {
                // Eğer kullanıcı veritabanında yoksa, yeni kayıt oluştur
                DiscordMember::create([
                    'discord_id' => $discordId,
                    'username' => $username,
                    'discriminator' => $discriminator,
                    'roles' => json_encode($roles),
                ]);
            }
        }

        return response()->json(['message' => 'Üyeler başarıyla işlendi'], 200);
    }


    public function sync()
    {
        $numbers = [
            "7815038042", "7411275071", "1392345797", "3893768519", "4107413579",
            "7806418468", "3553593157", "7921133505", "5878269108", "5260984280",
            "7727846771", "3776415998", "9269435922", "7077394836", "8121467040",
            "6596515707", "7382824758", "9019411033", "8121467040", "8121467040",
            "3157072624", "3963731322", "8491625540", "2259210488", "9444991807",
            "8251246719", "4907284170", "1402570442", "7873824002", "7097010891",
            "7284924250", "7744138624", "6455971173", "2651150126", "3427603455",
            "1214736629", "8601237467", "4295508545", "3676613841", "2303503177",
            "7577572113", "7037927642", "1843876234", "3795049562", "7089232925",
            "7449595201", "7751547972", "8550297413", "9362903552", "4726920939",
            "6921491780", "8416024191", "3296073681", "6052827448", "8965888434",
            "8263277132", "7095353673", "7815602573", "4246277133", "4034957342",
            "1402570442", "2539930467", "8453382858", "3987120627", "9881446901",
            "6354436112", "6329071523", "9475596400", "9904995124", "2323486551",
            "4724366366", "1011289277", "6672324131", "9084522920", "3035926934",
            "2074464732", "9060391316", "6393813867", "6084459251", "7254198588",
            "1935774933", "3309616872", "9863458189", "6269206477", "7906829838",
            "4113843678", "2762539381", "6911670542", "8414662547", "8554291438",
            "5479389685", "3800859419", "2886039698", "1648614624", "4834971287",
            "4834971287", "9065321391", "1348681204", "9997919270", "7834017829",
            "8749132331", "5306566240", "6393813867", "1381218013", "9428392618",
            "3044848749", "4835136294", "7744138624", "2666760042", "8711198138",
            "1305365973", "7873930551", "6007694943", "1590457246", "7830921370",
            "6530764510", "3906612399", "3795049562", "4363360555", "4891295422",
            "9393070017", "4184766683", "8171551743", "6596515707", "9885146747",
            "7265968151", "6340506630", "1525828263", "5121089048", "8909334107",
            "5260984280", "9997919270", "8414662547", "8971885002", "8690729770",
            "4021110954"
        ];

        $usernames = [
            "@idolofyouidol", "@vet.hek.emre", "@alcibiades34", "@rohanbeyi.", "@asimakdogan",
            "@Ercan2233", "@Hsyncpn", "@sezai_13", "@ceyhunuzun", "@mehmetgurbuz4358",
            "@x.rektless", "@saruman7721", "@ferhad6164", "@ugurbakar", "@pinar35",
            "@krcnerdl", "@Fon_2045", "@Mrt06", "@pinar35", "@pinar35", "@onurakca_",
            "@msandikci", "@crypto_mrypto", "@btn_kemal", "@mrtdgn35", "@wisehomeless777",
            "@tades23", "@mustafa071515", "@burcinokan", "@mebrtl", "@mertocrypto",
            "@tcriminal", "@crptago.", "@kinginthenorth3455", "@mmurat.222", "@skaya1402",
            "@Gürçay.G", "@talhaski", "@zuguzwang", "@cihadt", "@fpadcc", "@mustafasaka",
            "@yigit.027", "@ferdi6006", "@ptkerim", "@tombul_parmak", "@samet.candan",
            "@nukhetzh", "@Mfsonmez", "@ernelo", "@bahadir3886", "@coderfree", "@yavuzselim",
            "@dr.yakup", "@hashus0887", "@mr.sefabey", "@soulh_", "@Amphyoxus",
            "@GC", "@dexter.morgan13", "@mustafa071515", "@Ruling1320", "@burak.topuz",
            "@muhammedali2540", "@Viyaduk13", "@harungumus", "@tradingblocks", "@hektor2285",
            "@onrpnr", "@alpcamug", "@kmlnyr", "@mete0481", "@Spacefrog74", "@kemalos",
            "@thebenjx", "@h.ekin", "@murat.arslan", "@mahmes63", "@ekin65", "@yunusknt",
            "@emrahbulut", "@Wysl", "@haybinalim", "@Hakim", "@selim0618", "@denizozden",
            "@Torukmaktuuu", "@ahmet2285", "@comanche0103", "@Skorkmaz", "@volkan___",
            "@breenline", "@Aydin5331", "@abesim96", "@tuncaypeker", "@tuncayp",
            "@Psychoin", "@mustafaayaz", "@gsaca", "@hasandemirbas", "@kozi7612",
            "@adlkndll", "@mahmes63", "@osman_7301", "@medeniusul", "@serdar_brtcn",
            "@panoptikon", "@tcriminal", "@salihgirgin", "@devrimcetin", "@sojo_",
            "@kemalfst", "@Mustafa yıldız", "@Techo35", "@Metin9217", "@smh__smh",
            "@emrahgokmen", "@ferdi6006", "@reven.33", "@serhat024875", "@kemalfst",
            "@kerim3273", "@AU", "@krcnerdl", "borangk", "@mumtazer", "@huwarang",
            "@alix5705", "@ERHAN91", "@vinivici.lens", "@mehmetgurbuz4358", "@gsaca",
            "@comanche0103", "@colossol.", "@UGRBDM", "@emin3272"
        ];

        foreach ($numbers as $key => $number) {
            echo $number . " - " . $usernames[$key] . "<br>";

        }

    }

}

