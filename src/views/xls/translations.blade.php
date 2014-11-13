<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>

        <table>
            <thead>
                <tr>
                    <th>key</th>
                    @foreach( $locales as $locale )
                        <th>{{ $locale }}</th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @foreach( $translations as $key => $trans_locales )
                    <tr>
                        <td>{{ $key }}</td>
                        @foreach( $locales as $locale )
                            <td>
                                @if( isset( $trans_locales[$locale] ) )
                                {{ $trans_locales[$locale] }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>

        </table>

    </body>
</html>




