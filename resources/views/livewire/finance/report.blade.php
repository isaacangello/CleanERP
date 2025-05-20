<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Finance Report</title>
{{--    <link href="{{url('build/finance-report.css') }}">--}}
    @vite('resources/css/app.css')
{{--    <script src="https://cdn.tailwindcss.com"></script>--}}
    <style>*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: ;--tw-contain-size: ;--tw-contain-layout: ;--tw-contain-paint: ;--tw-contain-style:var() }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: ;--tw-contain-size: ;--tw-contain-layout: ;--tw-contain-paint: ;--tw-contain-style:var() }
        /* ! tailwindcss v3.4.14 | MIT License | https://tailwindcss.com */
        *,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}:host,html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";font-feature-settings:normal;font-variation-settings:normal;-webkit-tap-highlight-color:transparent}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}
        h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-feature-settings:normal;font-variation-settings:normal;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}
        table{text-indent:0;border-color:inherit;border-collapse:collapse}
        button,input,optgroup,select,textarea{font-family:inherit;font-feature-settings:inherit;font-variation-settings:inherit;font-size:100%;font-weight:inherit;line-height:inherit;letter-spacing:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}button,input:where([type=button]),input:where([type=reset]),input:where([type=submit]){-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}dialog{padding:0}textarea{resize:vertical}
        input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}
        audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}
        img,video{max-width:100%;height:auto}[hidden]:where(:not([hidden=until-found])){display:none}
        .col-span-2{grid-column:span 2 / span 2}
        .col-span-3{grid-column:span 3 / span 3}
        .col-span-4{grid-column:span 4 / span 4}
        .col-start-2{grid-column-start:2}
        .mx-auto{margin-left:auto;margin-right:auto}
        .mt-10{margin-top:2.5rem}
        .mt-3{margin-top:0.75rem}
        .grid{display:grid}
        .max-h-56{max-height:14rem}
        .w-36{width:9rem}
        .w-full{width:100%}
        .grid-flow-row{grid-auto-flow:row}
        .grid-cols-4{grid-template-columns:repeat(4, minmax(0, 1fr))}
        .gap-3{gap:0.75rem}
        .rounded{border-radius:0.25rem}
        .border{border-width:1px}
        .border-b{border-bottom-width:1px}
        .border-black{--tw-border-opacity:1;border-color:rgb(0 0 0 / var(--tw-border-opacity))}
        .border-gray-200{--tw-border-opacity:1;border-color:rgb(229 231 235 / var(--tw-border-opacity))}
        .border-green-700{--tw-border-opacity:1;border-color:rgb(21 128 61 / var(--tw-border-opacity))}
        .bg-green-700{--tw-bg-opacity:1;background-color:rgb(21 128 61 / var(--tw-bg-opacity))}
        .p-2{padding:0.5rem}
        .pb-0{padding-bottom:0}
        .pe-0{padding-inline-end:0}
        .pe-1{padding-inline-end:0.25rem}
        .pe-2{padding-inline-end:0.5rem}
        .pe-3{padding-inline-end:0.75rem}
        .ps-0{padding-inline-start:0}
        .ps-1{padding-inline-start:0.25rem}
        .pt-0{padding-top:0}
        .text-center{text-align:center}
        .text-start{text-align:start}
        .text-end{text-align:end}
        .text-2xl{font-size:1.5rem;line-height:2rem}
        .text-sm{font-size:0.875rem;line-height:1.25rem}
        .text-xl{font-size:1.25rem;line-height:1.75rem}
        .text-xs{font-size:0.75rem;line-height:1rem}
        .text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}
    </style>
</head>
<body>
<div class=" mx-auto "
     style="

        margin: 0 auto;
     "
>
    <table class="w-full" style=" margin-bottom: 20px;">
        <tr>
            <td  style="width: 24.9999%;">
                <img  alt="Logo" class="w-36  border border-1 border-gray-200 rounded"
                      style="
                                width: 7rem;
                                border: 1px solid rgb(229 231 235 / 1);
                                border-radius: 0.25rem;
                            "
                      src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQAAAAEACAYAAABccqhmAAAA0GVYSWZJSSoACAAAAAoAAAEEAAEAAAAAAQAAAQEEAAEAAAAAAQAAAgEDAAMAAACGAAAAEgEDAAEAAAABAAAAGgEFAAEAAACMAAAAGwEFAAEAAACUAAAAKAEDAAEAAAACAAAAMQECAA0AAACcAAAAMgECABQAAACqAAAAaYcEAAEAAAC+AAAAAAAAAAgACAAIAEgAAAABAAAASAAAAAEAAABHSU1QIDIuMTAuMzgAADIwMjU6MDM6MTEgMTU6MTk6MTQAAQABoAMAAQAAAAEAAAAAAAAA4fm5eQAAAYRpQ0NQSUNDIHByb2ZpbGUAAHicfZE9SMNAGIbfpkpFK4J2EHHIUJ3sokUctQpFqBBqhVYdTC79gyYNSYqLo+BacPBnserg4qyrg6sgCP6AuAtOii5S4ndJoUWMdxz38N73vtx9BwiNCtOsrllA020znUyI2dyqGHpFEH0YpBmXmWXMSVIKvuPrHgG+38V4ln/dn6NfzVsMCIjEs8wwbeIN4ulN2+C8TxxhJVklPieeMOmCxI9cVzx+41x0WeCZETOTnieOEIvFDlY6mJVMjThOHFU1nfKFrMcq5y3OWqXGWvfkLwzn9ZVlrtMaRRKLWIIEEQpqKKMCGzHadVIspOk84eMfcf0SuRRylcHIsYAqNMiuH/wPfvfWKkxNeknhBND94jgfY0BoF2jWHef72HGaJ0DwGbjS2/5qA5j5JL3e1qJHwMA2cHHd1pQ94HIHGH4yZFN2pSAtoVAA3s/om3LA0C3Qu+b1rXWO0wcgQ71K3QAHh8B4kbLXfd7d09m3f2ta/fsBnsZyuMUHu8wAAA14aVRYdFhNTDpjb20uYWRvYmUueG1wAAAAAAA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/Pgo8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJYTVAgQ29yZSA0LjQuMC1FeGl2MiI+CiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPgogIDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiCiAgICB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIKICAgIHhtbG5zOnN0RXZ0PSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VFdmVudCMiCiAgICB4bWxuczpkYz0iaHR0cDovL3B1cmwub3JnL2RjL2VsZW1lbnRzLzEuMS8iCiAgICB4bWxuczpHSU1QPSJodHRwOi8vd3d3LmdpbXAub3JnL3htcC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgeG1wTU06RG9jdW1lbnRJRD0iZ2ltcDpkb2NpZDpnaW1wOjYyZTM5NjgzLTkwZTQtNDBmNC1hNWZjLWZjYzMxNzhhZjNlZCIKICAgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo3ODE2YzlmMy1jNjY5LTRhODktYmQwNC00Nzc2MDcyZjI1N2QiCiAgIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDoyODYwYzA5OS05ZGVhLTQxYmItYjkwZC03MzIzYTZjZjE5ZGMiCiAgIGRjOkZvcm1hdD0iaW1hZ2UvcG5nIgogICBHSU1QOkFQST0iMi4wIgogICBHSU1QOlBsYXRmb3JtPSJMaW51eCIKICAgR0lNUDpUaW1lU3RhbXA9IjE3NDE3MTcxNTYxNTIyNDMiCiAgIEdJTVA6VmVyc2lvbj0iMi4xMC4zOCIKICAgdGlmZjpPcmllbnRhdGlvbj0iMSIKICAgeG1wOkNyZWF0b3JUb29sPSJHSU1QIDIuMTAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjU6MDM6MTFUMTU6MTk6MTQtMDM6MDAiCiAgIHhtcDpNb2RpZnlEYXRlPSIyMDI1OjAzOjExVDE1OjE5OjE0LTAzOjAwIj4KICAgPHhtcE1NOkhpc3Rvcnk+CiAgICA8cmRmOlNlcT4KICAgICA8cmRmOmxpCiAgICAgIHN0RXZ0OmFjdGlvbj0ic2F2ZWQiCiAgICAgIHN0RXZ0OmNoYW5nZWQ9Ii8iCiAgICAgIHN0RXZ0Omluc3RhbmNlSUQ9InhtcC5paWQ6NzExMmI1YTItMjdjNy00YjcxLThkNWQtMDVkNjFlOWJlYmY0IgogICAgICBzdEV2dDpzb2Z0d2FyZUFnZW50PSJHaW1wIDIuMTAgKExpbnV4KSIKICAgICAgc3RFdnQ6d2hlbj0iMjAyNS0wMy0xMVQxNToxOToxNi0wMzowMCIvPgogICAgPC9yZGY6U2VxPgogICA8L3htcE1NOkhpc3Rvcnk+CiAgPC9yZGY6RGVzY3JpcHRpb24+CiA8L3JkZjpSREY+CjwveDp4bXBtZXRhPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgCjw/eHBhY2tldCBlbmQ9InciPz4W5JLgAAAABmJLR0QA6QDpAOmjYq8iAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH6QMLEhMQDsQ70wAAIABJREFUeNrt3WtQVOfhP/Dv3pfd5X51QS6ii4CgGDUdFUHReE/UGK2Zqp2ay9hJp21e9GVn+qp90XbapjNmksbE2JimibFEjUakijcSL6AIchGRO8tFFljYZW9n/y/6P+cHCsuioKjfz5tOzXI4PGef73nOczsyr9frBRE9l+QsAiIGABExAIiIAUBEDAAiYgAQEQOAiBgARMQAICIGABExAIiIAUBEDAAiYgAQEQOAiBgARMQAICIGABExAIiIAUBEDAAiYgAQEQOAiBgARMQAICIGABExAIiIAUBEDAAiYgAQEQOAiBgARMQAICIGABExAIiIAUBEDAAiBgARMQCIiAFARAwAImIAEBEDgIgYAETEACAiBgARMQCIiAFARAwAImIAEBEDgIgYAETEACAiBgARMQCIiAFARAwAImIAEBEDgIgY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"
                />

            </td>
            <td>
                <table class="mt-3" style="margin-top:0.75rem; width: 100%">

                    <tr>
                        <th colspan="6" class="text-start" style="text-align: left; vertical-align: top;"><h4 class="text-2xl" style="font-size: 1.5rem;line-height: 2rem; ">Businness Name</h4></th>
                    </tr>
                    <tr >
                        <th colspan="6" class="text-start" style="text-align: left;"><h6 class="text-xl" style="font-size: 1.25rem;line-height: 1.75rem">{{$totalServicesPriceEmployee['emp_name']}}</h6></th>
                    </tr>
                    <tr>
                        <th class="pe-3 text-start" style="text-align: left; ">From:</th>
                        <td class="pe-3" style="text-align: left;" >{{Carbon\Carbon::create($totalServicesPriceEmployee['from'])->format('m/d/Y')}}</td>
                        <th class="pe-3" style="text-align: left;">Till:</th>
                        <td colspan="3" style="text-align: left;">{{Carbon\Carbon::create($totalServicesPriceEmployee['till'])->format('m/d/Y')}}</td>
                    </tr>

                    <tr>
                        <th class="pe-3 text-start" style="text-align: left">Total:</th>
                        <td class="pe-3">$ {{number_format($totalServicesPriceEmployee['cem'],2,".")}}</td>
                        <th class="pe-2">70%:</th>
                        <td class="pe-3">$ {{number_format($totalServicesPriceEmployee['setenta'],2,'.')}}</td>
                        <th class="pe-2">30%:</th>
                        <td class="pe-3">$ {{number_format($totalServicesPriceEmployee['trinta'],2)}}</td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>
    @if(!($message === "&nbsp;"))
        <table style="width: 100%; border-top: 1px solid dimgrey;margin: 5px 0; ">
            <tr>
                <td style="width: 100%; border-top: 1px solid dimgrey; padding-left: 2px">
                    <b>Notes: </b> {!! $message !!}
                </td>
            </tr>

        </table>
    @endif


            <table class="table-responsive table-sm w-full"
                   style="
                    width: 100%;
                    text-indent: 0;
                    border-collapse: collapse;
                   "

            >
                <thead>
                <tr class="bg-green-700 border border-1 border-green-700 text-white"
                    style="
                    background-color:rgb(21 128 61 / 1);
                    border: 1px solid rgb(21 128 61 / 1);
                    color: white;
                    font-size:0.75rem;
                    line-height:1rem;

                    "
                >
                    <th scope="col" class="ps-1 pt-0 pb-0 pe-0">Date</th>
                    <th scope="col" class="ps-1 pt-0 pb-0 pe-0">Customer</th>
                    <th scope="col" class="ps-1 pt-0 pb-0 pe-0">Price</th>
                    <th scope="col" class="ps-1 pt-0 pb-0 pe-0">30%</th>
                    <th scope="col" class="ps-1 pt-0 pb-0 pe-0">70%</th>
                    <th scope="col" class="ps-1 pt-0 pb-0 pe-0">Note</th>
                    <th scope="col" class="ps-1 pt-0 pb-0 pe-0">Payment Form</th>
                    <th scope="col" class="ps-1 pt-0 pb-0 pe-0">Final</th>
                </tr>
                </thead>
                <tbody>
{{--                {{dd($ServicesEmployee)}}--}}
@php
$count = 0;
@endphp
@foreach($ServicesEmployee as $key => $row)

@if($row->customer_id !== 1)


                @php
                    $plus = empty($row->plus)?  0:$row->plus;
                    $minus = empty($row->minus)?  0:$row->minus;
                    $price = empty($row->price)?  0:$row->price;
                    $total = $price + $plus + (-1)*($minus);
                    $payment_string= "&nbsp;";
                    if(is_numeric($row->payment)){
                        foreach ($payments as $line){
                            if ($row->payment === $line['id']){
                                $payment_string = $line['title'];
                            }
                        }
                     }
                    $style="
                            padding-top: 0;
                            padding-inline-end:0;
                            padding-inline-start:0.25rem;
                            font-size:0.75rem;
                            line-height:1rem;
                            border: 1px solid rgb(21 128 61 / 1);
                            padding-bottom: 0;
                            padding-left: 2;

                    ";

                    $classArray = [" background-color:rgb(229 231 235 /1);","background-color:#FFF;"];
                @endphp
                <tr>
                    <td style="{{$style}}{{Funcs::altClass($count,$classArray)}}" class="ps-1 pt-0 pb-0 pe-0 border border-1 border-green-700 text-xs">{{Carbon\Carbon::create($row->service_date)->format("m/d/Y")}}</td>
                    <td style="{{$style}}{{Funcs::altClass($count,$classArray)}}" class="ps-1 pt-0 pb-0 pe-0 border border-1 border-green-700 text-xs">{{$row->cust_name}}</td>
                    <td style="{{$style}}{{Funcs::altClass($count,$classArray)}}" class="ps-1 pt-0 pb-0 pe-0 border border-1 border-green-700 text-xs">$ {{number_format($total,2)}} </td>
                    <td style="{{$style}}{{Funcs::altClass($count,$classArray)}}" class="ps-1 pt-0 pb-0 pe-0 border border-1 border-green-700 text-xs">$ {{number_format( ($total*0.7)  ,2)}}  </td>
                    <td style="{{$style}}{{Funcs::altClass($count,$classArray)}}" class="ps-1 pt-0 pb-0 pe-0 border border-1 border-green-700 text-xs">$ {{number_format( ($total*0.3)  ,2)}} </td>
                    <td style="{{$style}}{{Funcs::altClass($count,$classArray)}}" class="ps-1 pt-0 pb-0 pe-0 border border-1 border-green-700 text-xs">{!! $row->finance_notes??" " !!}</td>
                    <td style="{{$style}}{{Funcs::altClass($count,$classArray)}}" class="ps-1 pt-0 pb-0 pe-0 border border-1 border-green-700 text-xs">{!! $payment_string !!} </td>
                    <td style="{{$style}}{{Funcs::altClass($count,$classArray)}}" class="ps-1 pt-0 pb-0 pe-0 border border-1 border-green-700 text-xs">@if($row->paid_out) Paid @endif</td>
                </tr>
                @php
                    $count++;
                @endphp

@endif
@endforeach
                <tr>
                    <td style="{{$style}}{{Funcs::altClass($count,$classArray)}}" class="ps-1 pt-0 pb-0 pe-0 border border-1 border-green-700">&nbsp;</td>
                    <th style="{{$style}} text-align:right; {{Funcs::altClass($count,$classArray)}}" class="ps-0 pt-0 pb-0 pe-1 text-end border border-1 border-green-700 text-sm">TOTAL</th>
                    <th style="{{$style}} text-align:left; {{Funcs::altClass($count,$classArray)}}" class="ps-1 pt-0 pb-0 pe-0 border border-1 border-green-700 text-sm">$ {{number_format($totalServicesPriceEmployee['cem'],2,".")}} </th>
                    <th style="{{$style}} text-align:left; {{Funcs::altClass($count,$classArray)}}" class="ps-1 pt-0 pb-0 pe-0 border border-1 border-green-700 text-sm">$ {{number_format($totalServicesPriceEmployee['setenta'],2,".")}} </th>
                    <th style="{{$style}} text-align:left; {{Funcs::altClass($count,$classArray)}}" class="ps-1 pt-0 pb-0 pe-0 border border-1 border-green-700 text-sm">$ {{number_format($totalServicesPriceEmployee['trinta'],2,".")}} </th>
                    <td style="{{$style}}{{Funcs::altClass($count,$classArray)}}" class="ps-1 pt-0 pb-0 pe-0 border border-1 border-green-700">&nbsp;</td>
                    <td style="{{$style}}{{Funcs::altClass($count,$classArray)}}" class="ps-1 pt-0 pb-0 pe-0 border border-1 border-green-700">&nbsp;</td>
                    <td style="{{$style}}{{Funcs::altClass($count,$classArray)}}" class="ps-1 pt-0 pb-0 pe-0 border border-1 border-green-700">&nbsp;</td>
                </tr>

                </tbody>
            </table>
        </div>
        <div class="col-span-2 col-start-2" style="margin: 0 auto; padding-top: 30px">
            <table class="w-full mt-10" style="width: 50%;margin: 0 auto;">
                <tbody>
                <tr>
                    <td class="border-b border-black w-full" style="border-bottom: 1px solid black">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="text-center">
                        Owner
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

</body>
</html>