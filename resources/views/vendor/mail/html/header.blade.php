@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <a
                    style="background-color: #dc3545;color: #fff; padding: 4px 18px;font-weight: 700;text-transform: uppercase;">
                    TYPHOON
                </a>
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
