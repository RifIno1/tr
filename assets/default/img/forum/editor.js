function buttons(TextareaName)
{
document.write(" <input type='button' value='B' class='frm' style='font-weight:bold;' onclick=\"code('"+TextareaName+"','b','b')\"/>");
document.write(" <input type='button' value='I' class='frm' style='font-style:italic;' onclick=\"code('"+TextareaName+"','i','i')\"/>");
document.write(" <input type='button' value='U' class='frm' style='text-decoration: underline;' onclick=\"code('"+TextareaName+"','u','u')\"/>");
document.write(" <input type='button' value='يمين' class='frm'  onclick=\"code('"+TextareaName+"','right','right')\"/>");
document.write(" <input type='button' value='توسيط' class='frm' onclick=\"code('"+TextareaName+"','center','center')\"/>");
document.write(" <input type='button' value='يسار' class='frm' onclick=\"code('"+TextareaName+"','left','left')\"/>");
document.write(" <input type='button' value='صورة' class='frm' onclick=\"code('"+TextareaName+"','img','img')\"/>");




}
function code(TextareaName,tag1,tag2){
if (document.selection)
            {
                var    textarea=document.getElementById(TextareaName);
                textarea.focus();
                var sel = document.selection.createRange();
                sel.text = "["+tag1+"]"+ sel.text + "[/"+tag2+"]";
            }
          else
          {
        var text=document.getElementById(TextareaName).value;
        var start=document.getElementById(TextareaName).selectionStart;
        var end=document.getElementById(TextareaName).selectionEnd;
        var tex=text.substring(start,end);
        document.getElementById(TextareaName).value=text.replace(tex,"["+tag1+"]"+tex+"[/"+tag2+"]");
        }
}



function smilie(TextareaName)
{
document.write("<img src='assets/default/img/forum/images/smiley/s1.png' border='0' onclick=\"smiley('"+TextareaName+"','[s1]')\"/>");
document.write("<img src='assets/default/img/forum/images/smiley/s2.png' border='0' onclick=\"smiley('"+TextareaName+"','[s2]')\"/>");
document.write("<img src='assets/default/img/forum/images/smiley/s3.png' border='0' onclick=\"smiley('"+TextareaName+"','[s3]')\"/>");
document.write("<br /><img src='assets/default/img/forum/images/smiley/s4.png' border='0' onclick=\"smiley('"+TextareaName+"','[s4]')\"/>");
document.write("<img src='assets/default/img/forum/images/smiley/s5.png' border='0' onclick=\"smiley('"+TextareaName+"','[s5]')\"/>");
document.write("<img src='assets/default/img/forum/images/smiley/s6.png' border='0' onclick=\"smiley('"+TextareaName+"','[s6]')\"/>");
document.write("<br /><img src='assets/default/img/forum/images/smiley/s7.png' border='0' onclick=\"smiley('"+TextareaName+"','[s7]')\"/>");
document.write("<img src='assets/default/img/forum/images/smiley/s8.png' border='0' onclick=\"smiley('"+TextareaName+"','[s8]')\"/>");
document.write("<img src='assets/default/img/forum/images/smiley/s9.png' border='0' onclick=\"smiley('"+TextareaName+"','[s9]')\"/>");
document.write("<br /><img src='assets/default/img/forum/images/smiley/s10.png' border='0' onclick=\"smiley('"+TextareaName+"','[s10]')\"/>");
document.write("<img src='assets/default/img/forum/images/smiley/s11.png' border='0' onclick=\"smiley('"+TextareaName+"','[s11]')\"/>");
document.write("<img src='assets/default/img/forum/images/smiley/s12.png' border='0' onclick=\"smiley('"+TextareaName+"','[s12]')\"/>");
document.write("<br /><img src='assets/default/img/forum/images/smiley/s13.png' border='0' onclick=\"smiley('"+TextareaName+"','[s13]')\"/>");
document.write("<img src='assets/default/img/forum/images/smiley/s14.png' border='0' onclick=\"smiley('"+TextareaName+"','[s14]')\"/>");
document.write("<img src='assets/default/img/forum/images/smiley/s15.png' border='0' onclick=\"smiley('"+TextareaName+"','[s15]')\"/>");
}

function smiley(TextareaName,tag){
if (document.selection)
            {
                var    textarea=document.getElementById(TextareaName);
                textarea.focus();
                var sel = document.selection.createRange();
                sel.text = sel.text +" "+tag+" ";
            }
          else
          {
        var text=document.getElementById(TextareaName).value;
        var start=document.getElementById(TextareaName).selectionStart;
        var end=document.getElementById(TextareaName).selectionEnd;
        var tex=text.substring(start,end);
        document.getElementById(TextareaName).value=text.replace(tex," "+tag+" ");
        }
}