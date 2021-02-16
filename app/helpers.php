<?php



function imageupload($file, $dir, $width = null, $height = null)
{
    $path = public_path() . '/' . $dir;
    if (!File::exists($path)) {
        File::makedirectory($path, 0777, true, true);
    }
    // dd($path);

    $fileextension = $file->getClientOriginalExtension();
    // dd($fileextension);

    if ($file != null) {
        $file_name = $dir . '/' . rand() . "." . $fileextension;
    } else {
        $file_name = ucfirst($path) . "-" . date('YmdHis') . rand(0, 9999) . "." . $fileextension;
    }
    // dd($file->getRealPath());

    if (isset($width) && isset($height)) {

        if ($file_name) {
            $img = Image::make($file);
            $img->fit($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->save($file_name);
        }
    } else {
        if ($file_name) {
            $file->move($path, $file_name);
        }
    }

    return $file_name;
    // end of file/image
}


//for nepali number
function getUnicodeNumber($input)
{
    $standard_numsets = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    $nepali_numsets = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
    return str_replace($standard_numsets, $nepali_numsets, $input);
}


function getvariable($input)
{
    $en_variable = ['Add', 'Edit'];
    $np_variable = ['थप्नुहोस्', 'परिवर्तन गर्नुहोस'];
    return str_replace($en_variable, $np_variable, $input);
}
