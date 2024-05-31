<?php

namespace developermarius\eventim\publicapi\models;

enum EventimCategoryType: string{

    case FREE_TIME = 'Freizeit';
    case FREE_TIME_ACTIVITIES = 'Aktivitäten';
    case FREE_TIME_EXHIBITIONS = 'Ausstellungen';
    case FREE_TIME_KARNEVAL = 'Karneval';
    case FREE_TIME_KIDS = 'Kinder';
    case FREE_TIME_CINEMA = 'Kino';
    case FREE_TIME_KOELSCH = 'Kölsch';
    case FREE_TIME_OCTOBER_FEST = 'Oktoberfeste';
    case FREE_TIME_PARTY = 'Party';
    case FREE_TIME_SILVESTER = 'Silvester';
    case FREE_TIME_OTHER_EVENTS = 'Weitere Events';
    case FREE_TIME_CIRCUS = 'Zirkus';

    case HUMOR = 'Humor';
    case HUMOR_COMEDY = 'Comedy';
    case HUMOR_CABARET = 'Kabarett';

    case CONCERT = 'Konzerte';
    case CONCERT_CLUB = 'Clubkonzerte';
    case CONCERT_COUNTRY_FOLK = 'Country & Folk';
    case CONCERT_ELECTRONIC_DANCE = 'Electronic & Dance';
    case CONCERT_FESTIVAL = 'Festivals';
    case CONCERT_HARD_HEAVY = 'Hard & Heavy';
    case CONCERT_HIPHOP_RNB = 'HipHop & R’n‘B';
    case CONCERT_JAZZ_BLUES = 'Jazz & Blues';
    case CONCERT_ROCK_POP = 'Rock & Pop';
    case CONCERT_SCHLAGER_FOLK_MUSIC = 'Schlager & Volksmusik';
    case CONCERT_OTHER_CONCERTS = 'Weitere Konzerte';

    case CULTURE = 'Kultur';
    case CULTURE_FESTIVE_GAMES = 'Festspiele';
    case CULTURE_CLASSIC = 'Klassische Konzerte';
    case CULTURE_CABARET = 'Kleinkunst';
    case CULTURE_LITERATURE = 'Literatur';
    case CULTURE_OPERA_OPERETTA = 'Oper & Operette';
    case CULTURE_DANCE = 'Tanz';
    case CULTURE_THEATRE = 'Theater';

    case MUSICAL_AND_SHOW = 'Musical & Show';
    case MUSICAL_AND_SHOW_MUSICAL = 'Musical';
    case MUSICAL_AND_PODCAST = 'Podcast';
    case MUSICAL_AND_SHOW_SHOW = 'Show';

    case SPORT = 'Sport';
    case SPORT_AMERICAN_FOOTBALL = 'American Football';
    case SPORT_BASKETBALL = 'Basketball';
    case SPORT_BOXING_WRESTLING = 'Boxen & Wrestling';
    case SPORT_ICE_HOCKEY = 'Eishockey';
    case SPORT_SOCCER = 'Fußball';
    case SPORT_HANDBALL = 'Handball';
    case SPORT_MOTORSPORT = 'Motorsport';
    case SPORT_EQUESTRIAN = 'Reitsport';
    case SPORT_TENNIS = 'Tennis';
    case SPORT_OTHER_EVENTS = 'Weitere Sport-Events';
    case SPORT_WINTER_SPORT = 'Wintersport';

    case TICKET_VOUCHER = 'Ticket-Gutschein';
    //Why have they the same name?!?! -> Lets hope this result never shows up
    //case TICKET_VOUCHER_GIFT_CARD = 'Ticket-Gutschein';

    case VIP_AND_EXTRAS = 'VIP & Extras';
    case VIP_AND_EXTRAS_SPECIALS = 'VIP & Specials';

    case O2_PRESALES = 'o2 Presales';
    case O2_PRESALES_PRIORITY_TICKETS = 'Priority Tickets';

    public function getParent(): ?EventimCategoryType{
        return match ($this){
            //Freizeit
            self::FREE_TIME_PARTY,
            self::FREE_TIME_ACTIVITIES,
            self::FREE_TIME_KIDS,
            self::FREE_TIME_EXHIBITIONS,
            self::FREE_TIME_OTHER_EVENTS,
            self::FREE_TIME_KOELSCH,
            self::FREE_TIME_OCTOBER_FEST,
            self::FREE_TIME_SILVESTER,
            self::FREE_TIME_CIRCUS => self::FREE_TIME,

            //Humor
            self::HUMOR_COMEDY,
            self::HUMOR_CABARET => self::HUMOR,
            //Kultur
            self::CULTURE_CLASSIC,
            self::CULTURE_CABARET,
            self::CULTURE_LITERATURE,
            self::CULTURE_OPERA_OPERETTA,
            self::CULTURE_DANCE,
            self::CULTURE_FESTIVE_GAMES,
            self::CULTURE_THEATRE => self::CULTURE,
            //Konzerte
            self::CONCERT_CLUB,
            self::CONCERT_COUNTRY_FOLK,
            self::CONCERT_ELECTRONIC_DANCE,
            self::CONCERT_FESTIVAL,
            self::CONCERT_HARD_HEAVY,
            self::CONCERT_HIPHOP_RNB,
            self::CONCERT_JAZZ_BLUES,
            self::CONCERT_ROCK_POP,
            self::CONCERT_SCHLAGER_FOLK_MUSIC,
            self::CONCERT_OTHER_CONCERTS => self::CONCERT,
            //Musical & Show
            self::MUSICAL_AND_SHOW_MUSICAL,
            self::MUSICAL_AND_PODCAST,
            self::MUSICAL_AND_SHOW_SHOW => self::MUSICAL_AND_SHOW,
            //Sport
            self::SPORT_BOXING_WRESTLING,
            self::SPORT_SOCCER,
            self::SPORT_MOTORSPORT,
            self::SPORT_TENNIS,
            self::SPORT_WINTER_SPORT,
            self::SPORT_ICE_HOCKEY,
            self::SPORT_HANDBALL,
            self::SPORT_EQUESTRIAN,
            self::SPORT_AMERICAN_FOOTBALL,
            self::SPORT_BASKETBALL,
            self::SPORT_OTHER_EVENTS => self::SPORT,
            //VIP & Extras
            self::VIP_AND_EXTRAS_SPECIALS => self::VIP_AND_EXTRAS,
            //o2 Presales
            self::O2_PRESALES_PRIORITY_TICKETS => self::O2_PRESALES,
            //Every other has no parents
            default => null
        };
    }
}
