#!/usr/bin/perl
@mag = <>;foreach $ln (@mag){$ln =~ s/.{25,48}\s{3,10}(.*)/\1/g; $sr = $1; $sr =~ s/2600 Magazine//; $sr
 =~ s/\s{2,}//g;if ((length($sr)>=3)){print "$sr\n";}};foreach $ln (@mag){$ln =~ s/(.{25,48})\s{3,10}.*/\1/g; $sl = $1; $sl=~ s/2
600 Magazine//;$sl=~ s/\s{2,}//g;if ((length($sl)>=3)){print "$sl\n";}};foreach $sm (@mag){if ($sm !~ m/.{25,48}\s{3,10}.*/){$sm 
=~ s/\s{2,}//;$sm =~ s/^ //;if (length($sm)>3){print $sm;}}}
