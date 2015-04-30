args <- commandArgs(TRUE);
N <- as.numeric(args[1]);
P <- as.character(args[2]);
Outdir <- as.character(args[3]);
Name <- as.character(args[4]);

library("exams");
invisible(Sys.setlocale(category = "LC_ALL", locale = "ru_RU.utf8"))
#testh <- exams2html(file="/var/www/Rnw/f.Rnw",n=N,dir="/var/www/Rnw/Rout",template="plain",name="htm_");
testh <- exams2html(file=P,n=N,dir=Outdir,template="plain",name=Name, encoding="UTF-8", quiet=TRUE);
testh
#testm <- exams2moodle(file="/var/www/Rnw/f.Rnw",n=5,dir="/var/www/Rnw/Rout",name="moo_");
