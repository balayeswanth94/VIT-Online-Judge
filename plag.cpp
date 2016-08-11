#include<iostream>
#include <fstream>
#include<vector>
#include<algorithm>
using namespace std;

int main()
{
	ifstream pth("pid.txt");
	vector<string> path,arr;
	string a,b;
	while(pth>>a)
	{
		path.push_back(a);
	}
	vector<string>::iterator it,it1,it2;
	for(it2=path.begin();it2!=path.end();it2++)
	{
		arr.clear();
		string prob=*it2;
		string path = "./" +*it2;
		string users = path+"/users.txt";
		ifstream infile(users.c_str());
		FILE * pFile;
		while(infile>>a)
		{
			arr.push_back(a);
			//cout<<a;
		}
		sort(arr.begin(),arr.end());
		it = unique(arr.begin(),arr.end());
		arr.resize(distance(arr.begin(),it));
		for(it=arr.begin();it!=arr.end();it++)
		{
			string acpy=*it;
			a =path+"/"+*it+".txt";
			ifstream ifs(a.c_str());
			string content( (std::istreambuf_iterator<char>(ifs) ),
        	               (std::istreambuf_iterator<char>()    ) );
			for(it1=it+1;it1!=arr.end();it1++)
			{
				string bcpy=*it1;
				b = path+"/"+*it1+".txt";
				ifstream ifs1(b.c_str());
				string content1( (std::istreambuf_iterator<char>(ifs1) ),
           	            (std::istreambuf_iterator<char>()    ) );
           	 	if(content==content1)
           	 	{
cout<<"HELLO";
           	 		string ban ="./admin/ban.txt";
           	 		pFile = fopen (ban.c_str(),"a+");
           	 		fprintf(pFile, "%s %s %s\n", acpy.c_str(),bcpy.c_str(),prob.c_str());
           	 		fclose (pFile);
				}
        	    	
			}
		}
	}
	return 0;
}
