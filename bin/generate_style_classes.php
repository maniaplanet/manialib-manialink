<?php
    const STYLES_URL = 'https://raw.githubusercontent.com/maniaplanet/documentation/gh-pages/creation/manialink/styles.json';
    const PHP_NAMESPACE = 'ManiaLib\Manialink\Styles';

function debug($message)
{
    print_r($message);
    echo "\n";
}

function writeClass($className, $sourceCode)
{
    $path = __DIR__ . '/../src/' . str_replace('\\', DIRECTORY_SEPARATOR, PHP_NAMESPACE) . DIRECTORY_SEPARATOR . $className . ".php";
    debug("Writing " . strlen($sourceCode) . "B to " . basename($path));
    file_put_contents($path, $sourceCode);
}

function filterKeyword($keyword)
{
    switch ($keyword) {
        case 'Default': return 'Default_';
        case 'Empty': return 'Empty_';
        case '3DStereo': return '_3DStereo';
        case '321Go': return '_321Go';
        case '1': return '_1';
        case '2': return '_2';
        case '3': return '_3';
        case 'Go!': return 'Go';
        case 'EnergyBar_0.25': return 'EnergyBar_025';
        case '#0': return '_0';
        case '#1': return '_1';
        case '#2': return '_2';
    }
    return $keyword;
}

function generateCode($style, array $substyles, $appendStyleInValues = true)
{
    $f_style     = filterKeyword($style);
    $f_substyles = array_map('filterKeyword', $substyles);

    $output   = array();
    $output[] = '<?php';
    $output[] = '';
    $output[] = 'namespace ' . PHP_NAMESPACE . ';';
    $output[] = '';
    $output[] = 'abstract class ' . $f_style;
    $output[] = '{';
    $output[] = '';
    foreach ($substyles as $key => $substyle) {
        $output[] = sprintf('    const %1$s = \'%2$s%3$s\';', $f_substyles[$key], $appendStyleInValues ? $style . ':' : '', $substyle);
    }
    $output[] = '';
    $output[] = '}';
    $output[] = '';
    return implode("\n", $output);
}

function generateStyles(array $styles)
{

    debug(count($styles) . " styles found");
    foreach ($styles as $style) {
        if (property_exists($style, 'styles') && count($style->styles) == 1 && property_exists($style, 'substyles') && count($style->substyles) > 0) {
            $sourceCode = generateCode($style->styles[0], $style->substyles, true);
            writeClass(filterKeyword($style->styles[0]), $sourceCode);
        } elseif (property_exists($style, 'styles') && count($style->styles) > 0 && !property_exists($style, 'substyles') && count($style->elements) == 1) {
            switch ($style->elements[0]) {
                case 'label':
                    $_style = 'LabelStyles';
                    break;

                case 'frame3d':
                    $_style = 'Frame3dStyles';
                    break;

                default:
                    throw new UnexpectedValueException('Woot');
            }
            $sourceCode = generateCode($_style, $style->styles, false);
            writeClass($_style, $sourceCode);
        } else {
            debug("Cannot process element");
        }
    }
}

$styles = json_decode(file_get_contents(STYLES_URL));
generateStyles($styles);

